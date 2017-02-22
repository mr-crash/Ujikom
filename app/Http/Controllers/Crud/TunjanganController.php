<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;

use Request;
use Validator;
use App\Tunjangan;
use App\Jabatan;
use App\Golongan;

class TunjanganController extends Controller
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
            $datas = Tunjangan::where($_GET['field'],'LIKE','%'.$_GET['search'].'%')->with('jabatan','golongan')->orderBy($_GET['field'])->paginate(100);
            $search = $_GET['search'];
            $field_old = $_GET['field'];
        }
        else if(isset($_GET['sortBy']))
        {
            $datas = Tunjangan::with('jabatan','golongan')->orderBy($_GET['sortBy'])->paginate(5);
        }
        else{
            $datas = Tunjangan::with('jabatan','golongan')->orderBy('created_at','DESC')->paginate(5);
        }
        $fields = (['id','kode_tunjangan','jabatan_id','golongan_id','status','jumlah_anak','besaran_uang']);
        // dd($datas);

        return view('crud.tunjangan.index', compact('datas','fields','search','field_old'));
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
        return view('crud.tunjangan.create',compact('jabatans','golongans'));
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
        $data = Request::all();
        $sama = Tunjangan::where('jabatan_id',$data['jabatan_id'])->where('golongan_id',$data['golongan_id'])->first();
        if(isset($sama->id)){
            // dd('sudah ada');
        }
        $validati = array(
            'kode_tunjangan'=>'required|unique:tunjangans',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'status'=>'required',
            'jumlah_anak'=>'required|max:2',
            'besaran_uang'=>'required|max:12',
            );

        $validation = Validator::make(Request::all(), $validati);


        if ($validation->fails()) {
            return redirect('tunjangan/create')->withErrors($validation)->withInput();
        }
        if($data['status']=='Belum Menikah'&&$data['jumlah_anak']>0)
        {
            return redirect('tunjangan/create?errors_ilegal');
        }
        $sama = Tunjangan::where('jabatan_id',$data['jabatan_id'])->where('golongan_id',$data['golongan_id'])->where('status',$data['status'])->where('jumlah_anak', $data['jumlah_anak'])->first();
        // dd($sama);
        if(isset($sama->id))
        {
            return redirect('tunjangan/create?errors_sama='.$sama->id);
        }
        Tunjangan::create($data);
        return redirect('tunjangan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Tunjangan::where('id',$id)->with('jabatan','golongan')->first();
        // dd($data);
        return view('crud.tunjangan.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Tunjangan::where('id',$id)->with('jabatan','golongan')->first();
        $jabatans = Jabatan::all();
        $golongans = Golongan::all();
        // dd($data);
        return view('crud.tunjangan.edit',compact('data','jabatans','golongans'));
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
        $old_data = Tunjangan::where('id', $id)->first();
        $validati = array(
            'kode_tunjangan'=>'required|unique:tunjangans',
            'jabatan_id'=>'required',
            'golongan_id'=>'required',
            'status'=>'required',
            'jumlah_anak'=>'required|max:2',
            'besaran_uang'=>'required|max:12',
            );

        if ($old_data->kode_tunjangan == $data['kode_tunjangan']){
            $validati['kode_tunjangan'] = 'required';
        }

        $validation = Validator::make(Request::all(), $validati);


        if ($validation->fails()) {
            return redirect('tunjangan/'.$id.'/edit')->withErrors($validation)->withInput();
        }
        if($data['status']=='Belum Menikah'&&$data['jumlah_anak']>0)
        {
            return redirect('tunjangan/'.$id.'/edit?errors_ilegal');
        }
        if($data['jabatan_id']!=$old_data['jabatan_id']||$data['golongan_id']!=$old_data['golongan_id']||$data['jumlah_anak']!=$old_data['jumlah_anak'])
        {
            $sama = Tunjangan::where('jabatan_id',$data['jabatan_id'])->where('golongan_id',$data['golongan_id'])->where('status',$data['status'])->where('jumlah_anak', $data['jumlah_anak'])->first();
            if(isset($sama->id))
            {
                return redirect('tunjangan/'.$id.'/edit?errors_sama='.$sama->id);
            }
        }
        // dd($data);
        Tunjangan::where('id',$id)->update([
            'kode_tunjangan'=>$data['kode_tunjangan'],
            'jabatan_id'=>$data['jabatan_id'],
            'golongan_id'=>$data['golongan_id'],
            'status'=>$data['status'],
            'jumlah_anak'=>$data['jumlah_anak'],
            'besaran_uang'=>$data['besaran_uang'],
            ]);
        $url = 'tunjangan/'.$id;
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
        Tunjangan::where('id', $id)->delete();

        return redirect('tunjangan');
    }
}
