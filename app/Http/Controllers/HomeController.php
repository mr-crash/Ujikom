<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pegawai;
use App\Penggajian;
use App\Tunjangan;
use App\lemburPegawai;

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
        $gajis = Penggajian::paginate(5);
        $tunjangans = Tunjangan::all();
        $lemburs = lemburPegawai::with('pegawai','kategori_lembur')->get();

        // dd($pegawais,$gajis,$tunjangans,$lemburs);

        return view('home',compact('pegawais','gajis','tunjangans','lemburs'));
    }
}
