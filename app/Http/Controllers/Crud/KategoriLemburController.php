<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\KategoriLembur;
use App\Jabatan;
use App\Golongan;
use Request;
use Validator;
use App\Pegawai;

class KategoriLemburController extends Controller
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
            $datas = KategoriLembur::where($_GET['field'],'LIKE','%'.$_GET['search'].'%')->with('jabatan','golongan')->orderBy($_GET['field'])->paginate(100);
            $search = $_GET['search'];
            $field_old = $_GET['field'];
        }
        else if(isset($_GET['sortBy']))
        {
            $datas = KategoriLembur::with('jabatan','golongan')->orderBy($_GET['sortBy'])->paginate(5);
        }
        else{
            $datas = KategoriLembur::with('jabatan','golongan')->orderBy('created_at','DESC')->paginate(5);
        }
        $fields = (['kode_lembur']);
        // dd($datas);

        return view('crud.kategori_lembur.index', compact('datas','fields','search','field_old'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatans = Jabatan::all();
        $golongans = Golongan::all();
        return view('crud.kategori_lembur.create',compact('jabatans','golongans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Request::all();
        $sama = KategoriLembur::where('jabatan_id',$data['jabatan_id'])->where('golongan_id',$data['golongan_id'])->first();

        if(isset($sama->id))
        {
            $ulr = 'kategori_lembur/'.$sama->id;
            return redirect('kategori_lembur/create?errors_unique&url='.$ulr);
        }


        $validati = array(
            'kode_lembur'=>'required|unique:kategori_lemburs',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'besaran_uang'=>'required|max:12'
            );

        $validation = Validator::make(Request::all(), $validati);

        if ($validation->fails()) {
            return redirect('kategori_lembur/create')->withErrors($validation)->withInput();
            
        }

        // dd(Request::all());

        KategoriLembur::create($data);

        return redirect('kategori_lembur');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = KategoriLembur::where('id',$id)->with('golongan','jabatan')->first();
        $pegawais = Pegawai::where('jabatan_id',$data->jabatan_id)->where('golongan_id',$data->golongan_id)->get();


        // dd($pegawais);

        return view('crud.kategori_lembur.view',compact('data','pegawais'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = KategoriLembur::where('id',$id)->with('golongan','jabatan')->first();
        $jabatan = Jabatan::all();
        $golongan = Golongan::all();
        // dd($data);
        return view('crud.kategori_lembur.edit', compact('data','jabatan','golongan'));
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
        // dd($data);
        $kode_lama = KategoriLembur::where('id', $id)->first()->kode_lembur;

        if ($data['kode_lembur'] != $kode_lama)
        {
        $validati = array(
            'kode_lembur'=>'required|unique:kategori_lemburs',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'besaran_uang'=>'required|max:12'
            );
        }
        else{
        $validati = array(
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'besaran_uang'=>'required|max:12'
            );
        }

        $validation = Validator::make(Request::all(), $validati);

        if ($validation->fails()) {
            return redirect('kategori_lembur/'.$id.'/edit')->withErrors($validation)->withInput();
            
        }

        // dd(Request::all());

        KategoriLembur::where('id', $id)->first()->update([
            'kode_lembur'=> $data['kode_lembur'],
            'jabatan_id'=> $data['jabatan_id'],
            'golongan_id'=> $data['golongan_id'],
            'besaran_uang'=> $data['besaran_uang']
            ]);
        $url = 'kategori_lembur/'.$id;
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KategoriLembur::where('id', $id)->first()->delete();

        return redirect ('kategori_lembur');
    }
}
