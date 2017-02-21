<?php $page = 'View Tunjangan Pegawai' ?>
<?php $root = 'tunjangan_pegawai' ?>
@extends('layouts.app')

@section('footer')
<a href="{{url('tunjangan_pegawai')}}">Tunjangan Pegawai</a> > <a href="{{url('tunjangan_pegawai',$data->id)}}">View</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$page}}</div>

                <div class="panel-body">
                    {{ csrf_field() }}
                    <table class="table">
                        <tr>
                            <td>{!! Form::label('pegawai') !!}</td>
                            <td>
                            <select name="id" class="form-control" disabled="">
                                <option>{{$pegawai->user->name}}</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                            <td colspan="2">Pilih tunjangan yang berkaitan</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <select name="kode_tunjangan_id" class="form-control" disabled="">
                                    <option>{{$data->tunjangan->status}} <?php if ($data->tunjangan->jumlah_anak == 0) {} else{echo 'jumlah anak '.$data->tunjangan->jumlah_anak;} ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="action-web" colspan="2">{!! Form::open(['method'=> 'DELETE', 'route'=>[$root.'.destroy',$data->id]]) !!}
                            {!! Form::submit('Delete', ['class'=>'btn btn-block btn-danger lebar']) !!}
                            {!! Form::close() !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
