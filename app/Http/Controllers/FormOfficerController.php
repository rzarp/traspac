<?php

namespace App\Http\Controllers;

use App\FormOfficer;
use App\Officer;
use App\Exports\FormExport;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use File;

class FormOfficerController extends Controller
{
 
    public function index()
    {
        $golongan = Officer::all();
        $eselon = $golongan;
        $jabatan = $golongan;
        
        return view('admin.officer.form-officer', compact('golongan', 'eselon', 'jabatan'));
    }
    

   
    public function store(Request $request)
    {
        $request->validate ([
            'nip'             => 'nullable',
            'nama'            => 'nullable',
            'tempat_lahir'    => 'nullable',
            'alamat'          => 'nullable',
            'tgl_lahir'       => 'required',
            'jenis_kelamin'   => 'required',
            'golongan'        => 'nullable',
            'eselon'          => 'nullable',
            'jabatan'         => 'nullable',
            'tempat_tugas'    => 'nullable',
            'agama'           => 'required',
            'unit_kerja'      => 'nullable',
            'no_hp'           => 'nullable',
            'npwp'            => 'nullable',
            'foto '           => 'nullable|max:3000|file|image',
        ]);

        $foto = null;
       
        if($request->hasFile('foto')) {
            $extFile = $request->foto->getClientOriginalExtension();
            $namaFile = 'foto-'.time().".".$extFile;
            $foto = $request->foto->move('img/form', $namaFile);
        } 

        DB::table('form_officers')

        ->insert([
            'nip'             => $request->nip,
            'nama'            => $request->nama,
            'tempat_lahir'    => $request->tempat_lahir,
            'alamat'          => $request->alamat,
            'tgl_lahir'       => $request->tgl_lahir,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'golongan'        => $request->golongan,
            'eselon'          => $request->eselon,
            'jabatan'         => $request->jabatan,
            'tempat_tugas'    => $request->tempat_tugas,
            'agama'           => $request->agama,
            'unit_kerja'      => $request->unit_kerja,
            'no_hp'           => $request->no_hp,
            'npwp'            => $request->npwp,
            'foto'            => $foto,      
        ]);

        return redirect(route('form-officer'))->with('pesan','Data Berhasil ditambahkan');
        
    }


    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = FormOfficer::with('golongan','eselon','jabatan')->get();
            return Datatables::of($data)
                    ->editColumn('created_at', function ($user) {
                        return [
                        'display' => e($user->created_at->format('d/m/Y H:i:s')),
                        'timestamp' => $user->created_at->timestamp
                        ];
                    })
                    ->editColumn('updated_at', function ($user) {
                        return [
                        'display' => ($user->updated_at->format('d/m/Y H:i:s')),
                        'timestamp' => $user->updated_at->timestamp
                        ];
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row)
                    {
   
                        $btn = 
                        '
                        <a href="'.route('edit.form',['id' => $row->id]).'" class="btn btn-primary btn-action mr-1 edit-confirm" data-toggle="tooltip" title="" data-original-title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                        <a href="'.route('delete.form',['id' => $row->id]).'" class="btn btn-danger btn-action trigger--fire-modal-2 delete-confirm" data-toggle="tooltip" title=""data-original-title="Delete"><i class="fas fa-trash"></i></a>
                        ';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.officer.viewform');
    }
    
    public function edit($id) {
        $golongan = Officer::all();
        $eselon = $golongan;
        $jabatan = $golongan;
        $form = FormOfficer::find($id);
        return view('admin.officer.edit-form',compact('golongan', 'eselon', 'jabatan', 'form'));
    }

    public function update(Request $request, $id)
    {
        $form = FormOfficer::find($id);
        $request->validate ([
            'nip'             => 'nullable',
            'nama'            => 'nullable',
            'tempat_lahir'    => 'nullable',
            'alamat'          => 'nullable',
            'tgl_lahir'       => 'required',
            'jenis_kelamin'   => 'required',
            'golongan'        => 'nullable',
            'eselon'          => 'nullable',
            'jabatan'         => 'nullable',
            'tempat_tugas'    => 'nullable',
            'agama'           => 'required',
            'unit_kerja'      => 'nullable',
            'no_hp'           => 'nullable',
            'npwp'            => 'nullable',
            'foto '           => 'nullable|max:3000|file|image',
        ]);

        if (isset($request->foto)) {
            $request->validate ([
                'foto '         => 'nullable',
            ]);
                if($request->hasFile('foto')) {
                    $extFile = $request->foto->getClientOriginalExtension();
                    $namaFile = 'foto-'.time().".".$extFile;
                    $foto = $request->foto->move('img/form', $namaFile);
                } 
        }


        DB::table('form_officers')
            ->where('id', $id)
            ->update([
                'nip'             => $request->nip,
                'nama'            => $request->nama,
                'tempat_lahir'    => $request->tempat_lahir,
                'alamat'          => $request->alamat,
                'tgl_lahir'       => $request->tgl_lahir,
                'jenis_kelamin'   => $request->jenis_kelamin,
                'golongan'        => $request->golongan,
                'eselon'          => $request->eselon,
                'jabatan'         => $request->jabatan,
                'tempat_tugas'    => $request->tempat_tugas,
                'agama'           => $request->agama,
                'unit_kerja'      => $request->unit_kerja,
                'no_hp'           => $request->no_hp,
                'npwp'            => $request->npwp,  
                'foto'            => (isset($foto) ? $foto : $form->foto)  
            ]);

        return redirect(route('edit.form',$id))->with('pesan','Data Berhasil diupdate');
    }

    public function destroy($id)
    {
        $foto = DB::table('form_officers')->where('id',$id)->first();
        if($foto->foto != 'img/form/noimage.png') {
            File::delete($foto->foto);
        }
        DB::table('form_officers')->where('id',$id)->delete();
        return redirect(route('show-officer'))->with('pesan','Data Berhasil dihapus!');
    }

    public function export_excel(Request $request)
	{
		return Excel::download(new FormExport, 'form.xls');
	}
}
