<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\FormOfficer;
use DB;
use Js;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {
        return view('home');
    }
    public function adminHome()
    {
        $form = DB::table('form_officers')->count();
        return view('admin.dashboard', compact('form'));
    }
}
