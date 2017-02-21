<?php $page = $data->user->name.' Edit' ?>
<?php $root = 'pegawai' ?>
@extends('layouts.app')

@section('footer')
<a href="{{url('pegawai')}}">Pegawai</a> > <a href="{{url('pegawai','update')}}">Update</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        {!! Form::model($data,(['method'=>'PATCH','route'=>['pegawai.update',$data->id],'enctype'=>'multipart/form-data' ])) !!}
        {{ csrf_field() }}
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Data Akun</div>
                <div class="panel-body">
                    <table class="table">
                    <tr>
                        <td>
                            <label for="name" class="col-md-4 control-label">Name</label>
                        </td>
                        <td>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $data->user->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="email" class="col-md-4 control-label">Email</label>
                        </td>
                        <td>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" class="form-control" name="email" value="{{ $data->user->email }}">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="type_user" class="col-md-4 control-label">Permisions</label>
                        </td>
                        <td>
                            <div class="form-group{{ $errors->has('type_user') ? ' has-error' : '' }}">
                            <?php 
                                $selection = [''=>''];
                                if (Auth::user()->type_user == 'admin') {
                                    $selection['admin']='Admin';
                                }
                                    $selection['hrd']='HRD';
                                    $selection['pegawai']='Pegawai';
                             ?>
                                {!! Form::select('type_user',$selection,$data->user->type_user,['class'=>'form-control']) !!}
                                @if ($errors->has('type_user'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_user') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password" class="col-md-4 control-label">Password</label>
                        </td>
                        <td>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="text" class="form-control" name="password" value="{{ old('password') }}">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                        <span class="help-block">
                                            <strong>Kosongkan bila tidak akan mengubah</strong>
                                        </span>
                            </div>
                        </td>
                    </tr>
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
                            {!! Form::text('nip',null,['class'=>'form-control']) !!}
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
                            <select name="jabatan_id" class="form-control">
                                <option value=""></option>
                                @foreach ($jabatans as $jabatan)
                                <option value="{{$jabatan->id}}" <?php if ($data->jabatan_id==$jabatan->id) {echo "selected";} ?>>{{$jabatan->nama_jabatan}}</option>
                                @endforeach
                            </select>
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
                            <select name="golongan_id" class="form-control">
                                <option value=""></option>
                                @foreach ($golongans as $golongan)
                                <option value="{{$golongan->id}}" <?php if ($data->golongan_id==$golongan->id) {echo "selected";} ?>>{{$golongan->nama_golongan}}</option>
                                @endforeach
                            </select>
                            </div>
                            @if ($errors->has('golongan_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('golongan_id') }}</strong>
                                </span>
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
                                <span class="help-block">
                                    <strong>Kosongkan bila tidak akan mengubah</strong>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">{!! Form::submit('Update',['class'=>'btn btn-warning']) !!}</td>
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
