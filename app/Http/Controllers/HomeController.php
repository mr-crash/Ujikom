<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pegawai;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais = Pegawai::with('user','jabatan','golongan','tunjangan_pegawai')->get();
        return view('home',compact('pegawais'));
    }
}
