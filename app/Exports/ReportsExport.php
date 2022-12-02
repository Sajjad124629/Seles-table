<?php

namespace App\Exports;

use App\Models\sales;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportsExport implements FromView,ShouldAutoSize
{


    public function view(): View
    {
        //
        // use Exportable;

        $exceldata = sales::all();

        return view('excel.report-excel',["exceldata"=>$exceldata]);


    }
}
