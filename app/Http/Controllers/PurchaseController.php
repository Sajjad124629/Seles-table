<?php

namespace App\Http\Controllers;

use App\Exports\ReportsExport;
use App\Models\Expense;
use App\Models\ExpenseCategory;
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

        $getdata = ExpenseCategory::all();



        return view('purchase.expense',['expenseCategory'=>$getdata]);

    }

    public function insert(Request $request){

        $validator = Validator::make($request->all(), [
            'date'=>'required',
            'expense'=>'required',
            'notes'=>'required',
            'expense_category_id'=>'required',
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
            $get_expense->expense_category_id = $request->expense_category_id;
            $get_expense->save();

            $get_details = new ExpenseDetail;

            $get_details->date = $request->date;
            $get_details->amount = $request->amount;
            $get_details->notes = $request->notes;
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
        ->join('expense_categories', 'expenses.expense_category_id', '=', 'expense_categories.expense_category_id')
        ->select('expense_details.expense_details_id','expense_details.date', 'expense_details.amount', 'expense_details.notes', 'expenses.expense_name','expense_categories.expense_category_name')
        ->get();

        return response()->json([
            'expense'=>$getdata,


        ]);

    }

    public function edit_expense($id){
        $getExpenseDetails = ExpenseDetail::find($id);



        $getExpense = Expense::find($getExpenseDetails->expense_id);

        $getExpenseCategory = ExpenseCategory::find($getExpense->expense_category_id);

        return response()->json([
            'status' => 200,
            'expenseDetails' => $getExpenseDetails,
            'expense' => $getExpense,
            'expenseCategory'=>$getExpenseCategory
        ]);
    }

    public function update_expense(Request $request,$id){
        $validator = Validator::make($request->all(), [

            'expense'=>'required',
            'notes'=>'required',
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
                'errors'=>'Update Fail Fill All Section'
            ]);
        }
        else{
            $getExpenseDetails = ExpenseDetail::find($id);

            $getExpenseData = Expense::find($getExpenseDetails->expense_id);
            $getExpenseCategory = ExpenseCategory::find($getExpenseData->expense_category_id);
            $getExpenseCategory->expense_category_name = $request->edit_expense_category;
            $getExpenseCategory->save();
            $getExpenseData->expense_name = $request->expense;
            $getExpenseData->save();

            $getExpenseDetails->amount = $request->amount;
            $getExpenseDetails->notes = $request->notes;

            $getExpenseDetails->save();

            return response()->json([
                'status'=>200,
                'success'=>'Expense Update Successfully'
            ]);
        }
    }

    public function delete_expense($id){
        $getExpenseDetails = ExpenseDetail::find($id);



        $getExpense = Expense::find($getExpenseDetails->expense_id);

        $getExpense->delete();

        $getExpenseDetails->delete();

        return response()->json([
            'status' => 200,
            'delete' => 'Expense Delete Successfully'
        ]);
    }




    //*************************Full Expense List


    public function ExpenseList(Request $request)
    {
        // if ($request->ajax()) {
        //     $data = Ajax::all();
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {

        //             $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

        //             $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);

        // }
        return view('purchase.allExpenseList');
    }



}
