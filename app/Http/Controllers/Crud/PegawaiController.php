<?php

namespace App\Http\Controllers\Crud;


use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use App\Pegawai;
use App\Jabatan;
use App\Golongan;
use App\User;
use App\KategoriLembur;
use Request;
use Validator;
use Html;
use Input;

class PegawaiController extends Controller
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
    use RegistersUsers;

    public function index()
    {
        if (isset($_GET['search'])) {
            $datas = Pegawai::where($_GET['field'],'LIKE','%'.$_GET['search'].'%')->with('user','jabatan','golongan')->orderBy($_GET['field'])->paginate(100);
            $search = $_GET['search'];
            $field_old = $_GET['field'];
        }
        else if(isset($_GET['sortBy']))
        {
            $datas = Pegawai::with('user','jabatan','golongan')->orderBy($_GET['sortBy'])->paginate(5);
        }
        else{
            $datas = Pegawai::with('user','jabatan','golongan')->orderBy('created_at','DESC')->paginate(5);
        }
        $fields = (['id','nip','user_id','jabatan_id','golongan_id']);
        // dd($datas);

        return view('crud.pegawai.index', compact('datas','fields','search','field_old'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $jabatans = Jabatan::all();
        $golongans = Golongan::all();
        return view('crud.pegawai.create', compact('users','jabatans','golongans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validati = ([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'type_user' => 'required',
            'password' => 'required|min:6',
            'nip'=>'required|numeric|unique:pegawais|min:9',
            'jabatan_id' => 'required',
            'golongan_id' => 'required',
            ]);
        $validation = Validator::make(Request::all(), $validati);

        if ($validation->fails()) {
            return redirect('pegawai/create')->withErrors($validation)->withInput();
        }

        $data = Request::all();
        // dd($data);
        $user = User::create([
            'name' => $data['name'],
            'type_user' =>$data['type_user'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            ]);

        if(isset($_POST['foto']))
        {
            $file = Input::file('foto');
            $destination_path = public_path().'/account/';
            // $filename = $file->getClientOriginalName();
            $filename = $user->id.'_'.$user->name.'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destination_path,$filename);
            $foto = $filename;            
        }
        else
        {
            $foto = 'default.png';
        }


        Pegawai::create([
            'nip' => $data['nip'],
            'user_id' => $user->id,
            'jabatan_id' => $data['jabatan_id'],
            'golongan_id' => $data['golongan_id'],
            'foto' => $foto,
            ]);

        return redirect('pegawai');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pegawai::where('id',$id)->with('jabatan','user','golongan','lembur_pegawai')->first();
        $kategori_lembur = KategoriLembur::all();
        // dd($kategori_lembur);
        return view('crud.pegawai.view', compact('data','kategori_lembur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pegawai::where('id', $id)->with('jabatan', 'golongan', 'user')->first();
        $jabatans = Jabatan::all();
        $golongans = Golongan::all();
        // dd($data);

        return view('crud.pegawai.edit', compact('data','jabatans','golongans','kategori_lembur'));
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
        $old_pegawai = Pegawai::where('id', $id)->first();
        $old_email = User::where('id', $old_pegawai->user_id)->first()->email;
        $old_password = User::where('id', $old_pegawai->user_id)->first()->password;
        $data = Request::all();

        $validati = ([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'type_user' => 'required',
            'password' => 'required|min:6',
            'nip'=>'required|unique:pegawais',
            'jabatan_id' => 'required',
            'golongan_id' => 'required',
            'foto' => 'required',
            ]);
        if ($old_email==$data['email']) {
            $validati['email'] = '';
            $data['email'] = $old_email;
        }
        if ($data['password']==null) {
            $validati['password'] = '';
            $data['password'] = $old_password;
        }
        else{
            $validati['password'] = 'min:6';
            $data['password'] = bcrypt($data['password']);
        }
        if (Input::file() == null)
        {
            $validati['foto'] = '';
        }
        if ($data['nip']==$old_pegawai['nip'])
        {
            $validati['nip'] = '';
        }
        else{
            $validati['nip'] = 'required|unique:pegawais';
        }

        $validation = Validator::make(Request::all(), $validati);

        if ($validation->fails()) {
            return redirect('pegawai/'.$id.'/edit')->withErrors($validation)->withInput();
        }

        $user = User::where('id', $old_pegawai->user_id)->first()->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'type_user' => $data['type_user'],
            'password' => $data['password'],
            ]);
        $user = User::where('id', $old_pegawai->user_id)->first();


        if (Input::file()==null)
        {
            $data['foto'] = $old_pegawai->foto;
        }
        else
        {
            $file = Input::file('foto');
            $destination_path = public_path().'/account/';
            $filename = $user->id.'_'.$user->name.'_'.$file->getClientOriginalName();
            $uploadSuccess = $file->move($destination_path,$filename);
            $data['foto'] = $filename;
        }

        Pegawai::where('id', $id)->first()->update([
            'nip' => $data['nip'],
            'jabatan_id' => $data['jabatan_id'],
            'golongan_id' => $data['golongan_id'],
            'foto' => $data['foto'],
            ]);



        $url = 'pegawai/'.$id;
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
        $user_id = Pegawai::where('id', $id)->first()->user_id;

        Pegawai::where('id',$id)->first()->delete();
        User::where('id',$user_id)->first()->delete();

        return redirect('pegawai');
    }
}
