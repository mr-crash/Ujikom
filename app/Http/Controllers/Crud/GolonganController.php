<?php

namespace App\Http\Controllers\Crud;

use Request;
use App\Http\Controllers\Controller;

use App\Golongan;
use Validator;

class GolonganController extends Controller
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
            $datas = Golongan::where($_GET['field'],'LIKE','%'.$_GET['search'].'%')->orderBy($_GET['field'])->paginate(100);
            $search = $_GET['search'];
            $field_old = $_GET['field'];
        }
        else if(isset($_GET['sortBy']))
        {
            $datas = Golongan::orderBy($_GET['sortBy'])->paginate(5);
        }
        else{
            $datas = Golongan::orderBy('created_at','DESC')->paginate(5);
        }
        $fields = (['kode_golongan','nama_golongan']);
        // dd($datas);

        return view('crud.golongan.index', compact('datas','fields','search','field_old'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.golongan.create');
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
            'kode_golongan'=>'required|unique:golongans',
            'nama_golongan'=>'required',
            'tunjangan_uang'=>'required|max:12'
            );

        $alert = array(
            'kode_golongan.unique'=>'Please refresh browser and input again',
            );

        $validation = Validator::make(Request::all(), $validati, $alert);

        if ($validation->fails()) {
            return redirect('golongan/create')->withErrors($validation)->withInput();
            
        }

        // dd(Request::all());

        Golongan::create(Request::all());
        return redirect('golongan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Golongan::where('id',$id)->first();

        // dd($data);

        return view('crud.golongan.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Golongan::where('id',$id)->first();
        // dd($data);

        return view('crud.golongan.edit', compact('data'));
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
        $kode_lama = Golongan::where('id', $id)->first()->kode_golongan;

        if ($data['kode_golongan'] != $kode_lama)
        {
        $validati = array(
            'kode_golongan'=>'required|unique:golongans',
            'nama_golongan'=>'required',
            'tunjangan_uang'=>'required|max:12'
            );
        }
        else{
        $validati = array(
            'nama_golongan'=>'required',
            'tunjangan_uang'=>'required|max:12'
            );
        }
        $alert = array(
            'kode_golongan.unique'=>'Please refresh browser and input again',
            );

        $validation = Validator::make(Request::all(), $validati, $alert);

        if ($validation->fails()) {
            return redirect('golongan/'.$id.'/edit')->withErrors($validation)->withInput();
            
        }

        // dd(Request::all());

        Golongan::where('id', $id)->first()->update([
            'kode_golongan'=> $data['kode_golongan'],
            'nama_golongan'=> $data['nama_golongan'],
            'tunjangan_uang'=> $data['tunjangan_uang']
            ]);
        $url = 'golongan/'.$id;
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
        Golongan::where('id', $id)->first()->delete();

        return redirect('golongan');
        //
    }
}
