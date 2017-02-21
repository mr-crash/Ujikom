<?php

namespace App\Http\Controllers\Crud;

use Request;
use App\Http\Controllers\Controller;

use App\Pegawai;
use App\Golongan;
use App\Jabatan;
use App\KategoriLembur;
use App\LemburPegawai;
use App\Tunjangan;
use App\TunjanganPegawai;
use App\User;
use App\Penggajian;

use Carbon\Carbon;
use Validator;

class PenggajianController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['search'])) {
            $datas = Penggajian::with('tunjangan_pegawai')->where($_GET['field'],'LIKE','%'.$_GET['search'].'%')->orderBy($_GET['field'])->paginate(100);
            $search = $_GET['search'];
            $field_old = $_GET['field'];
        }
        else if(isset($_GET['sortBy']))
        {
            $datas = Penggajian::with('tunjangan_pegawai')->orderBy($_GET['sortBy'])->paginate(5);
        }
        else{
            $datas = Penggajian::with('tunjangan_pegawai')->orderBy('created_at','DESC')->paginate(5);
        }
        $fields = (['id','tunjangan_pegawai_id','jumlah_jam_lembur','jumlah_uang_lembur','gaji_pokok','total_gaji']);
        $pegawais = Pegawai::with('user')->get();
        // dd($datas);

        return view('crud.penggajian.index', compact('pegawais','datas','fields','search','field_old'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawais = Pegawai::all();
        // dd($datas);
        return view('crud.penggajian.create',compact('pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penggajian = array(); 
        $data = Request::all();
        $pegawai = Pegawai::where('id',$data['id'])->with('user','lembur_pegawai','golongan','jabatan','tunjangan_pegawai')->first();
        if(!isset($pegawai->tunjangan_pegawai->id))
        {
            return redirect('penggajian/'.'create'.'/?errors=notunjangan');
        }

        if(isset($pegawai->lembur_pegawai->first()->id))
        {
            $penggajian['lembur_pegawai_id'] = $pegawai->tunjangan_pegawai->id;
            $kategori_lembur_id = $pegawai->lembur_pegawai->first()->kategori_lembur_id;
            $kategori_lembur = KategoriLembur::where('id',$kategori_lembur_id)->first();
            $penggajian['jumlah_jam_lembur']=0;
            $penggajian['jumlah_uang_lembur']=0;
            $uang_lembur = $kategori_lembur;
            foreach ($pegawai->lembur_pegawai as $data) {
                $penggajian['jumlah_jam_lembur']+=$data->jumlah_jam;
                $penggajian['jumlah_uang_lembur']+=$kategori_lembur->besaran_uang*$data->jumlah_jam;
            }
        }
        else
        {
            $penggajian['jumlah_jam_lembur']=0;
            $penggajian['jumlah_uang_lembur']=0;
        }
        $gaji_jabatan = $pegawai->jabatan->tunjangan_uang;
        $gaji_golongan = $pegawai->golongan->tunjangan_uang;
        if (isset($pegawai->tunjangan_pegawai->id))
        {
            $penggajian['tunjangan_pegawai_id']=$pegawai->tunjangan_pegawai->id;
            $tunjangan_pegawai = TunjanganPegawai::where('id',$pegawai->tunjangan_pegawai->id)->first();
        if (isset(Tunjangan::where('id',$pegawai->tunjangan_pegawai->kode_tunjangan_id)->first()->besaran_uang)) {
            $tunjangan = Tunjangan::where('id',$pegawai->tunjangan_pegawai->kode_tunjangan_id)->first()->besaran_uang;
        }
        else{
            $tunjangan = 0;
        }
        }
        else{
            $tunjangan = 0;
            $penggajian['tunjangan_pegawai_id']=null;
        }

        $penggajian['gaji_pokok'] = $gaji_jabatan + $gaji_golongan;
        $penggajian['total_gaji'] = $penggajian['gaji_pokok']+$penggajian['jumlah_uang_lembur']+$tunjangan;
        if(!isset($penggajian['tunjangan_pegawai_id'])){
            return redirect('penggajian/'.'create'.'/?errors=notunjangan');
        }

        // dd($penggajian);

        $penggajian = Penggajian::create($penggajian);
        return redirect('penggajian');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
