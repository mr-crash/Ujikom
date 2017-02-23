<?php $page = $data->user->name ?>
<?php $root = 'pegawai' ?>
@extends('layouts.'.config('app.layout'))

@section('footer')
<a href="{{url('pegawai')}}">Pegawai</a> > <a href="{{url('pegawai','create')}}">View</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body" align="center">
                    <div class="foto-profile" style="background-image: url({{url('account',$data->foto)}})">
                    <div class="foto-comment"><a href="{{url('account',$data->foto)}}" class="btn btn-default" style="background-color: #222;color: #fff;">Image</a></div>
                        <!-- <img src="{{url('account',$data->foto)}}" class="fp"> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {!! Form::open(['url'=>$root,'enctype'=>'multipart/form-data']) !!}
        {{ csrf_field() }}
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Data Akun</div>
                <div class="panel-body">
                    <table class="table">
                    <tr><td>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            {!! Form::label('name',$data->user->name,['class'=>'form-control']) !!}

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    </td></tr><tr><td>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Email</label>

                        <div class="col-md-6">
                            {!! Form::label('name',$data->user->email,['class'=>'form-control']) !!}

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    </td></tr><tr><td>
                    <div class="form-group{{ $errors->has('type_user') ? ' has-error' : '' }}">
                        <label for="type_user" class="col-md-4 control-label">Permisions</label>

                        <div class="col-md-6">
                            {!! Form::select('type_user',[''=>$data->user->type_user],'',['class'=>'form-control','disabled']) !!}
                            @if ($errors->has('type_user'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type_user') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    </td></tr><tr><td>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <a href="#" class="btn btn-block btn-danger disabled">Bcrypt Data</a>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    </td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Data Pegawai</div>
                <div class="panel-body">
                	<table class="table">
                		<tr>
                			<td>{!! Form::label('NIP') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
                			{!! Form::label('nip',$data->nip,['class'=>'form-control']) !!}
                			</div>
                        	@if ($errors->has('nip'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('nip') }}</strong>
	                            </span>
                        	@endif
                        </td>
                		</tr>
                        <tr>
                            <td>{!! Form::label('Jabatan') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('jabatan_id') ? ' has-error' : '' }}">
                            {!! Form::label('jabatan',$data->jabatan->nama_jabatan,['class'=>'form-control']) !!}
                            </div>
                            @if ($errors->has('jabatan_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jabatan_id') }}</strong>
                                </span>
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{!! Form::label('Golongan') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('golongan_id') ? ' has-error' : '' }}">
                            {!! Form::label('golongan',$data->golongan->nama_golongan,['class'=>'form-control']) !!}
                            </div>
                            @if ($errors->has('golongan_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('golongan_id') }}</strong>
                                </span>
                            @endif
                            </td>
                        </tr>
                		<tr>
                			<td><a href="{{route('pegawai.edit',$data->id)}}" class="btn btn-block btn-warning">Edit</a></td>
                            <td>
                            {!! Form::open(['method'=> 'DELETE', 'route'=>['pegawai.destroy',$data->id]]) !!}
                            {!! Form::submit('Delete', ['class'=>'btn btn-block btn-danger lebar']) !!}
                            {!! Form::close() !!}</td>
                		</tr>
                	</table>
                </div>
            </div>
        </div>
{!! Form::close() !!}
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Lembur</div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah Jam</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_pendapatan = 0; ?>
                            @foreach($data->lembur_pegawai as $lembur)
                            <tr>
                                <td>{{$lembur->created_at}}</td>
                                <td>{{$lembur->jumlah_jam}}</td>
                                <?php 
                                    $pendapatan = $lembur->jumlah_jam*$kategori_lembur->where('id',$lembur->kategori_lembur_id)->first()->besaran_uang;
                                    $total_pendapatan+=$pendapatan;
                                    $pendapatan = number_format($pendapatan,2,',','.');
                                 ?>
                                <td align="right">Rp. {{$pendapatan}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="success"></td>
                                <td class="success">Total</td>
                                <td align="right" class="success">{{'Rp. '.number_format($total_pendapatan,2,',','.')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
