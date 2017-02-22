<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\TunjanganPegawai;
use App\Tunjangan;
use App\Pegawai;
use App\User;
use Request;
use Validator;

class TunjanganPegawaiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin-hrd');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['search'])) {
            $datas = TunjanganPegawai::where($_GET['field'],'LIKE','%'.$_GET['search'].'%')->with('pegawai','tunjangan')->orderBy($_GET['field'])->paginate(100);
            $search = $_GET['search'];
            $field_old = $_GET['field'];
        }
        else if(isset($_GET['sortBy']))
        {
            $datas = TunjanganPegawai::with('pegawai','tunjangan')->orderBy($_GET['sortBy'])->paginate(5);
        }
        else{
            $datas = TunjanganPegawai::with('pegawai','tunjangan')->orderBy('created_at','DESC')->paginate(5);
        }
        $fields = (['id','kode_tunjangan_id','pegawai_id']);
        // dd($datas);

        return view('crud.tunjangan_pegawai.index', compact('datas','fields','search','field_old'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pegawais = Pegawai::with('user')->get();

        return view('crud.tunjangan_pegawai.create',compact('pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(Request::all());
        $validati = array(
            'id'=>'required',
            'pegawai_id'=>'unique:tunjangan_pegawais',
            );
        $alert = array(
            'pegawai_id.unique' => 'Maaf, Pegawai ini telah memiliki tunjangan yang terdaftar',
            );

        $validation = Validator::make(Request::all(), $validati,$alert);

        if ($validation->fails()) {
            return redirect('tunjangan_pegawai/create')->withErrors($validation)->withInput();
        }

        $data = Request::all();
        $pegawai = Pegawai::where('id',$data['id'])->first();
        $check = Tunjangan::where('jabatan_id',$pegawai->jabatan_id)->where('golongan_id',$pegawai->golongan_id)->get();
        // dd($check);
        if(isset($_POST['pegawai_id'])){
            // dd(Request::all());
            $data = Request::all();
            TunjanganPegawai::create([
                'kode_tunjangan_id' => $data['kode_tunjangan_id'],
                'pegawai_id' => $data['pegawai_id'],
                ]);
            return redirect('tunjangan_pegawai');
        }
        if(!isset($check->first()->id)){
            $tunjangans = Tunjangan::all();
            $pegawais = Pegawai::with('user')->get();
            $error_ktnf = true;
            return view('crud.tunjangan_pegawai.create',compact('pegawais','error_ktnf'));
        }
        else{
            $pegawais = Pegawai::with('user')->get();
            return view('crud.tunjangan_pegawai.create',compact('pegawais','pegawai','check'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = TunjanganPegawai::where('id',$id)->with('pegawai','tunjangan')->first();
        $pegawai = Pegawai::where('id',$data->pegawai_id)->with('user')->first();
        return view('crud.tunjangan_pegawai.view', compact('data','pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
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
        // dd('delete');
        TunjanganPegawai::where('id',$id)->first()->delete();
        return redirect('tunjangan_pegawai');
    }
}
