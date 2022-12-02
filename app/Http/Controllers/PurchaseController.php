<?php

namespace App\Http\Controllers;

use App\Exports\ReportsExport;
use App\Models\sales;
use Illuminate\Http\Request;
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
}
