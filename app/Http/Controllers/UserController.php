<?php

namespace App\Http\Controllers;
use App\User;
Use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index() {
        return view('admin.setting.setting', [
            'user' => User::findOrFail(auth()->user()->id)
        ]);
    }

    public function updateProfile(Request $request)
    {
        $id = auth()->user()->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ];
        if($request->password) 
        {
            $data['password'] = Hash::make($request->password);
        }
        User::where('id', $id)->update($data);
        return redirect(route('setting'))->with('pesan','Data Berhasil diupdate');
    }
}
