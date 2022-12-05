<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    //

    public function bank_list(){
        $all_bank_datas = Bank::all() ;
        return view('bank.bankList',['all_bank_datas'=>$all_bank_datas]);
    }

    public function add_bank(){

        return view('bank.addBank');
    }

    public function insert_bank(Request $request){
        //Validate Inputs

        $request->validate([
            'bank_name'=>'required',
            'is_active'=>'required',
        ]);


        $insert_datas = new Bank;
        $insert_datas->bank_name = $request->bank_name;
        $insert_datas->is_active = $request->is_active;
         $save=  $insert_datas->save();
         if($save){
            return redirect('/bank-list')->with('success',$insert_datas->bank_name.' Bank Add SuccessFully');
         }
         else{
            return redirect()->back()->with('fail','Something went wrong, Please Try Again');
         }

    }

    public function edit_bank($id){

        $getdata = Bank::find($id);

         return view('bank.editBank',['getdatas'=>$getdata]);
     }

     public function update_bank(Request $request,$id){
        //Validate Inputs

        $request->validate([
            'bank_name'=>'required',
            'is_active'=>'required',
        ]);


        $update_data = Bank::find($id);
        $update_data->bank_name =  $request->bank_name;
        $update_data->is_active =  $request->is_active;
        $save =  $update_data->save();
        if ($save) {

            return redirect('/bank-list')->with('update', 'Bank Update SuccessFully');
        }
        else{
            return redirect()->back()->with('updatefail', 'Something went wrong, Please Try Again');
        }
    }
}
