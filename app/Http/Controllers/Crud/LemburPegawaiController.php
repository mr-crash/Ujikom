<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\LemburPegawai;
use App\Pegawai;
use App\Jabatan;
use App\KategoriLembur;
use App\User;
use Request;
use Validator;
use DB;

class LemburPegawaiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin-keuangan');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['search'])) {
            $datas = LemburPegawai::where($_GET['field'],'LIKE','%'.$_GET['search'].'%')->with('pegawai')->orderBy($_GET['field'])->paginate(100);
            $search = $_GET['search'];
            $field_old = $_GET['field'];
        }
        else if(isset($_GET['sortBy']))
        {
            $datas = LemburPegawai::with('pegawai')->orderBy($_GET['sortBy'])->paginate(5);
        }
        else{
            $datas = LemburPegawai::with('pegawai')->orderBy('created_at','DESC')->paginate(5);
        }
        $users = User::all();
        $jabatans = Jabatan::all();
        $fields = (['id','kode_lembur','kategori_lembur_id','pegawai_id','jumlah_jam']);
        // dd($datas);

        return view('crud.lembur_pegawai.index', compact('datas','jabatans','users','fields','search','field_old'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori_lemburs = KategoriLembur::all();
        $pegawais = Pegawai::with('user')->get();
        return view('crud.lembur_pegawai.create',compact('pegawais','kategori_lemburs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $kategori_lemburs = KategoriLembur::all();
        $pegawais = Pegawai::with('user')->get();
        $data = Request::all();
        $validati = array(
            'pegawai_id'=>'required',
            'jumlah_jam'=>'required|max:3',
            );

        $validation = Validator::make(Request::all(), $validati);


        if ($validation->fails()) {
            return redirect('lembur_pegawai/create')->withErrors($validation)->withInput();
        }
        $pegawai = Pegawai::where('id',$data['pegawai_id'])->first();
        $check = KategoriLembur::where('jabatan_id', $pegawai->jabatan_id)->where('golongan_id',$pegawai->golongan_id)->first();
        // dd($check);
        if(!isset($check)){
            $error_klnf = true;
            return view('crud.lembur_pegawai.create',compact('kategori_lemburs','pegawais','error_klnf'));
        }

        $data['kategori_lembur_id'] = $check->id;
        // dd($data);
        LemburPegawai::create($data);

        return redirect('lembur_pegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = LemburPegawai::where('id',$id)->with('pegawai','kategori_lembur')->first();
        $users = User::all();

        // dd($data);

        return view('crud.lembur_pegawai.view',compact('data','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = LemburPegawai::find($id);
        $kategori_lemburs = KategoriLembur::all();
        $pegawais = Pegawai::with('user')->get();
        return view('crud.lembur_pegawai.edit',compact('data','kategori_lemburs','pegawais'));
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
        $data = Request::all();
        $validati = array(
            'pegawai_id'=>'required',
            'jumlah_jam'=>'required|max:3',
            );
        $old_kode = LemburPegawai::where('id',$id)->first()->kode_lembur;

        $validation = Validator::make(Request::all(), $validati);


        if ($validation->fails()) {
            return redirect('lembur_pegawai/'.$id.'/edit')->withErrors($validation)->withInput();
        }
        $pegawai = Pegawai::where('id',$data['pegawai_id'])->first();
        $check = KategoriLembur::where('jabatan_id',$pegawai->jabatan_id)->where('golongan_id',$pegawai->golongan_id)->first();
        // dd($check);
        if(!isset($check)){
            $error_klnf = true;
            return Redirect('lembur_pegawai/'.$id.'/edit?error=klnf');
        }
        $data['kategori_lembur_id'] = $check->id;
        LemburPegawai::where('id',$id)->update([
            'kode_lembur' => $data['kode_lembur'],
            'kategori_lembur_id' => $data['kategori_lembur_id'],
            'pegawai_id' => $data['pegawai_id'],
            'jumlah_jam' => $data['jumlah_jam'],
            ]);
        return redirect('lembur_pegawai/'.$id);
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
        LemburPegawai::where('id',$id)->delete();
        return redirect('lembur_pegawai');
    }
}
