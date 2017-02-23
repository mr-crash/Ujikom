<?php $page = 'Create Tunjangan Pegawai' ?>
<?php $root = 'tunjangan_pegawai' ?>
@extends('layouts.'.config('app.layout'))

@section('footer')
<a href="{{url('tunjangan_pegawai')}}">Tunjangan Pegawai</a> > <a href="{{url('tunjangan_pegawai','create')}}">Create</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$page}}</div>

                <div class="panel-body">
                	{!! Form::open(['url'=>$root]) !!}
                    {{ csrf_field() }}
                	<table class="table">
                            @if(isset($check))
                        <tr>
                            <td>Pilih tunjangan yang berkaitan</td>
                        </tr>
                        <input type="hidden" name="id" value="{{$pegawai->id}}">
                        <input type="hidden" name="pegawai_id" value="{{$pegawai->id}}">
                        <tr>
                            <td>
                                <div class="form-group{{ $errors->has('kode_tunjangan_id') ? ' has-error' : '' }}">
                                    <select name="kode_tunjangan_id" class="form-control">
                                        @foreach($check as $data)
                                        <option value="{{$data->id}}">{{$data->status}} <?php if ($data->jumlah_anak == 0) {} else{echo 'jumlah anak '.$data->jumlah_anak;} ?></option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">
                            @if(!isset($check->first()->id))
                            {!! Form::submit('Create',['class'=>'btn btn-success','disabled']) !!}
                            @else
                            {!! Form::submit('Create',['class'=>'btn btn-success']) !!}
                            @endif
                            </td>
                        </tr>
                            @else
                        <tr>
                            <td>{!! Form::label('pegawai') !!}</td>
                            <td>
                            @if(!isset($pegawais->first()->id))
                            <div class="btn btn-block btn-danger disabled">Table Pegawai is Null</div>
                            @else
                            <div class="form-group{{ $errors->has('pegawai_id') ? ' has-error' : '' }}">
                            <select name="id" class="form-control">
                                <option></option>
                                @foreach($pegawais as $pegawai)
                                <option value="{{$pegawai->id}}">{{$pegawai->user->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            @if (isset($error_ktnf))
                            <span class="help-block">
                                    <strong>Pegawai ini tidak memiliki tunjangan yang sesuai dengan jabatan dan golongannya</strong><br>
                                    <strong>Silahkan untuk membuatnya <a href="{{url('tunjangan','create')}}">disini</a></strong>
                            </span>
                            @endif
                            @if ($errors->has('pegawai_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pegawai_id') }}</strong>
                                </span>
                            @endif
                        </td>
                        </tr>
                            @endif
                        <tr>
                            <td colspan="2" align="right">
                            @if(!isset($pegawais->first()->id))
                            {!! Form::submit('Next',['class'=>'btn btn-success','disabled']) !!}
                            @else
                            {!! Form::submit('Next',['class'=>'btn btn-success']) !!}
                            @endif
                            </td>
                        </tr>
                    @endif
                        
                    </table>
                	{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
