<?php

namespace App\Http\Controllers;

use App\Exports\ReportsExport;
use App\Models\Expense;
use App\Models\ExpenseDetail;
use Illuminate\Support\Facades\Validator;
use App\Models\sales;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseController extends Controller
{
    //

    public function purchase_view(){
        $searchdate1 = request()->query('search_date');
        $searchdate2 = request()->query('search_date1');
        if($searchdate1 or $searchdate2){
            $search_query = sales::whereBetween('created_at',[$searchdate1,$searchdate2])->get();
        }
        else{
            $search_query = sales::all();
        }
        $getdatas = $search_query;
        return view('purchase.purchaseReport',['getdatas'=>$getdatas]);
    }

    public function excel_export(){
        return Excel::download(new ReportsExport, 'report.xlsx');
    }

    public function csv_export(){
        return Excel::download(new ReportsExport, 'report.csv');
    }


    //payment field

    public function payment_field(){

        return view('purchase.paymentField');
    }

    //expense

    public function expense(){


        return view('purchase.expense');

    }

    public function insert(Request $request){

        $validator = Validator::make($request->all(), [
            'date'=>'required',
            'expense'=>'required',
            'employee'=>'required',
            'amount'=>'required|numeric|min:0',
        ]);

        if($request->amount<0){
            return response()->json([
                'status'=>400,
                'errors'=>'Amount Section must be positive'
            ]);
        }

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>'Please Fill All Section'
            ]);
        }

        else{
            $get_expense = new Expense;
            $get_expense->expense_name = $request->expense;
            $get_expense->save();

            $get_details = new ExpenseDetail;

            $get_details->date = $request->date;
            $get_details->amount = $request->amount;
            $get_details->expense_id =  $get_expense->expense_id;
            $get_details->save();
             return response()->json([
                'status' =>200,
                'success' => 'Add Successfully'
            ]);
        }



    }

    public function getdata(){
        $getdata = DB::table('expense_details')
        ->join('expenses', 'expense_details.expense_id', '=', 'expenses.expense_id')
        ->select('expense_details.expense_details_id','expense_details.date', 'expense_details.amount', 'expense_details.notes', 'expenses.expense_name')
        ->get();

        $getsub_expense = ExpenseDetail::get()->sum('amount');

        return response()->json([
            'expense'=>$getdata,
            'amount'=>$getsub_expense
        ]);

    }


}
