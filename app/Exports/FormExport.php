<?php

namespace App\Exports;

use App\FormOfficer;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class FormExport implements FromView,ShouldAutoSize
{
 
    use Exportable;

   

    public function view(): View {

        $data = FormOfficer::with('golongan','eselon','jabatan')->get();

      
        // return $data;
        foreach ($data as $d => $value ) {
            $data[$d]->golongan=$value->golongan()->get()[0]->golongan;
            $data[$d]->eselon=$value->eselon()->get()[0]->eselon;
            $data[$d]->jabatan=$value->jabatan()->get()[0]->jabatan;
            
        }
        // dd($data);

        return view('export.export-form',[
            'form' => $data,
        ]);
    }
    
}
