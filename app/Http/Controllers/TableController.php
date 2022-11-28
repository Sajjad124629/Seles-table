<?php

namespace App\Http\Controllers;

use App\Models\sales;
use Http;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class TableController extends Controller
{
    //
   public function index(){

    $search = request()->query('search_email');
    $search2 = request()->query('search_first_name');
    $search3 = request()->query('search_last_name');
    $search4 = request()->query("search_company_name");
    $search5 = request()->query("search_date");
    $search6 = request()->query("search_country");

    // if($search and $search2==""){
    //     $search_data = sales::where('first','Like',"%{$search}%")->paginate(10);
    //     // $search_data2 = sales::where('last','Like',"%{$search}%")->paginate(10);



    //     // $search_data = $search_data2->merge( $search_data1);

    // }
    // elseif($search =="" and $search2){
    //     $search_data = sales::where('last','Like',"%{$search2}%")->paginate(10);
    // }

    // if($search3 or $search4){
    //     $search_data = sales::whereBetween("created_at",[$search3, $search4])->get();







    // }
    if($search){
        $search_data = sales::where('email','Like',"%{$search}%")->get();
    }
    elseif($search2){
        $search_data = sales::where('first','Like',"%{$search2}%")->get();
    }
    elseif($search3){
        $search_data = sales::where('last','Like',"%{$search3}%")->get();
    }
    elseif($search4){
        $search_data = sales::where('company','Like',"%{$search4}%")->get();
    }
    elseif($search5){
        $search_data = sales::where('created_at','Like',"%{$search5}%")->get();
    }
    elseif($search6){
        $search_data = sales::where('country','Like',"%{$search6}%")->get();
    }
    else{
        $search_data = sales::paginate(100);
    }

    $res = $search_data;

    return view("table",["getdata"=>$res,]);
   }


   //pdf generate

   public function generate_pdf(){

    $search_data = sales::paginate(10);
    $res = $search_data;

    $pdf = Pdf::loadView('pdf.table',["getdata"=>$res,]);
    return $pdf->download('Sajjad.pdf');
   }
   public function download_pdf(){

   }

}


