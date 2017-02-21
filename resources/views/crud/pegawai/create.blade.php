<?php $page = 'Create Pegawai' ?>
<?php $root = 'pegawai' ?>
@extends('layouts.app')

@section('footer')
<a href="{{url('pegawai')}}">Pegawai</a> > <a href="{{url('pegawai','create')}}">Create</a>
@endsection

@section('content')
<div class="container">
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
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus="">

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
                            <input id="email" class="form-control" name="email" value="{{ old('email') }}">

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
                            <?php 
                                $selection = [''=>''];
                                if (Auth::user()->type_user == 'admin') {
                                    $selection['admin']='Admin';
                                }
                                    $selection['hrd']='HRD';
                                    $selection['pegawai']='Pegawai';
                             ?>
                            {!! Form::select('type_user',$selection,'',['class'=>'form-control']) !!}
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
                            <input id="password" type="text" class="form-control" name="password" value="{{ old('password') }}">

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
                            <?php $nip = ''.rand(111,999).''.rand(111,999).''.rand(111,999).''; ?>
                            <!-- {!! Form::label('nip',$nip,['class'=>'form-control','min'=>'9','max'=>'9','disabled']) !!} -->
                            {!! Form::text('nip',$nip,['class'=>'form-control','min'=>'9','max'=>'9']) !!}
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
                            @if(!isset($jabatans->first()->id))
                            <div class="col-md-12 btn btn-danger disabled">Mohon untuk mengisi data jabatan terlebih dahulu</div>
                            @else
                            <div class="form-group{{ $errors->has('jabatan_id') ? ' has-error' : '' }}">
                            <select name="jabatan_id" class="form-control">
                                <option value=""></option>
                                @foreach ($jabatans as $jabatan)
                                <option value="{{$jabatan->id}}">{{$jabatan->nama_jabatan}}</option>
                                @endforeach
                            </select>
                            </div>
                            @if ($errors->has('jabatan_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jabatan_id') }}</strong>
                                </span>
                            @endif
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{!! Form::label('Golongan') !!}</td>
                            <td>
                            @if(!isset($golongans->first()->id))
                            <div class="col-md-12 btn btn-danger disabled">Mohon untuk mengisi data golongan terlebih dahulu</div>
                            @else
                            <div class="form-group{{ $errors->has('golongan_id') ? ' has-error' : '' }}">
                            <select name="golongan_id" class="form-control">
                                <option value=""></option>
                                @foreach ($golongans as $golongan)
                                <option value="{{$golongan->id}}">{{$golongan->nama_golongan}}</option>
                                @endforeach
                            </select>
                            </div>
                            @if ($errors->has('golongan_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('golongan_id') }}</strong>
                                </span>
                            @endif
                            @endif
                            </td>
                        </tr>
                		<tr>
                			<td>{!! Form::label('Foto') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
                			<div class="form-group">
                                {!! Form::file('foto',['class'=>'form-control']) !!}
                            </div>
                			</div>
                        	@if ($errors->has('foto'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('foto') }}</strong>
	                            </span>
                        	@endif
							</td>
                		</tr>
                		<tr>
                			<td colspan="2" align="right">
                            @if(!isset($jabatans->first()->id)||!isset($golongans->first()->id))
                            {!! Form::submit('Create',['class'=>'btn btn-success','disabled']) !!}
                            @else
                            {!! Form::submit('Create',['class'=>'btn btn-success']) !!}
                            @endif
                            </td>
                		</tr>
                	</table>
                </div>
            </div>
        </div>
{!! Form::close() !!}
    </div>
</div>
@include('layouts.footer')
@endsection
