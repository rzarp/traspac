<?php

namespace App\Http\Controllers;

use App\Officer;
use Illuminate\Http\Request;
use DB;
use Auth;

class OfficerController extends Controller
{
  
    public function index()
    {
        $officer = Officer::paginate(10);
        return view ('admin.officer.officer',['officer'=>$officer]);
    }

   
    public function store(Request $request)
    {

        
        $request->validate ([
            'golongan'     => 'nullable',
            'eselon'       => 'nullable',
            'jabatan'      => 'nullable',
        ]);
        
        DB::table('officers')
    
        ->insert([
            'golongan'   => $request->golongan,
            'eselon'     => $request->eselon,
            'jabatan'    => $request->jabatan,
        ]);

        return redirect(route('officer'))->with('pesan','Data Berhasil ditambahkan');
    }


    public function destroy($id)
    {
        $officer = DB::table('officers')->where('id',$id)->first();
        DB::table('officers')->where('id',$id)->delete();
        return redirect(route('officer'))->with('pesan','Data Berhasil dihapus!');
    }
}
