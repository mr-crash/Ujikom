<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Request;
use App\Jabatan;
use Html;
use Validator;
use Form;
use Input;

class JabatanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin-keuangan-hrd');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['search'])) {
            $datas = Jabatan::where($_GET['field'],'LIKE','%'.$_GET['search'].'%')->orderBy($_GET['field'])->paginate(100);
            $search = $_GET['search'];
            $field_old = $_GET['field'];
        }
        else if(isset($_GET['sortBy']))
        {
            $datas = Jabatan::orderBy($_GET['sortBy'])->paginate(5);
        }
        else{
            $datas = Jabatan::orderBy('created_at','DESC')->paginate(5);
        }
        $fields = (['id','kode_jabatan','nama_jabatan']);
        // dd($datas);

        return view('crud.jabatan.index', compact('datas','fields','search','field_old'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.jabatan.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validati = array(
            'kode_jabatan'=>'required|unique:jabatans',
            'nama_jabatan'=>'required',
            'tunjangan_uang'=>'required|max:12'
            );
        $alert = array(
            'kode_jabatan.unique'=>'Please refresh browser and input again',
            );

        $validation = Validator::make(Request::all(), $validati,$alert);

        if ($validation->fails()) {
            return redirect('jabatan/create')->withErrors($validation)->withInput();
            
        }

        // dd(Request::all());

        Jabatan::create(Request::all());
        return redirect('jabatan');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Jabatan::where('id',$id)->with('pegawai')->first();

        // dd($data);

        return view('crud.jabatan.view',compact('data'));
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
        $data = Jabatan::where('id',$id)->first();
        // dd($data);

        return view('crud.jabatan.edit', compact('data'));
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
        $data = Request::all();
        // dd($data);
        $kode_lama = Jabatan::where('id', $id)->first()->kode_jabatan;

        if ($data['kode_jabatan'] != $kode_lama)
        {
        $validati = array(
            'kode_jabatan'=>'required|unique:jabatans',
            'nama_jabatan'=>'required',
            'tunjangan_uang'=>'required|max:12'
            );
        }
        else{
        $validati = array(
            'nama_jabatan'=>'required',
            'tunjangan_uang'=>'required|max:12'
            );
        }
        $alert = array(
            'kode_jabatan.unique'=>'Please refresh browser and input again',
            );

        $validation = Validator::make(Request::all(), $validati, $alert);

        if ($validation->fails()) {
            return redirect('jabatan/'.$id.'/edit')->withErrors($validation)->withInput();
            
        }

        Jabatan::where('id', $id)->first()->update([
            'kode_jabatan'=> $data['kode_jabatan'],
            'nama_jabatan'=> $data['nama_jabatan'],
            'tunjangan_uang'=> $data['tunjangan_uang']
            ]);
        $url = 'jabatan/'.$id;
        return redirect($url);
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
        Jabatan::where('id',$id)->first()->delete();

        return redirect('jabatan');
        //
    }
}
