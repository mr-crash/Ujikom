<?php $page = 'Penerimaan Gaji' ?>
<?php $root = 'penggajian' ?>
@extends('layouts.'.config('app.layout'))

@section('footer')
<a href="{{url($root)}}">Penggajian</a> > <a href="{{url($root,'create')}}">Penerimaan</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{$page}}</div>

                <div class="panel-body">
                    {!! Form::model($data,(['method'=>'PATCH','route'=>['penggajian.update',$data->id]])) !!}
                    {{ csrf_field() }}
                	<table class="table table-hover">
                        <tr>
                            <td>Nama Pegawai</td>
                            <td>{!! Form::label('',$pegawai->user->name,['class'=>'form-control']) !!}</td>
                        </tr>
                        <tr>
                            <td>Jabatan {{$pegawai->jabatan->nama_jabatan}}</td>
                            <td>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <?php $pegawai->jabatan->tunjangan_uang = number_format($pegawai->jabatan->tunjangan_uang,0,',','.'); ?>
                                {!! Form::label('tunjangan_uang',$pegawai->jabatan->tunjangan_uang,['class'=>'form-control','id'=>'appendprepend']) !!}
                                <span class="input-group-addon">.00</span>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Golongan {{$pegawai->golongan->nama_golongan}}</td>
                            <td>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <?php $pegawai->golongan->tunjangan_uang = number_format($pegawai->golongan->tunjangan_uang,0,',','.'); ?>
                                {!! Form::label('tunjangan_uang',$pegawai->golongan->tunjangan_uang,['class'=>'form-control','id'=>'appendprepend']) !!}
                                <span class="input-group-addon">.00</span>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Gaji Pokok</td>
                            <td>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <?php $data->gaji_pokok = number_format($data->gaji_pokok,2,',','.'); ?>
                                {!! Form::label('besaran_uang',$data->gaji_pokok,['class'=>'form-control','id'=>'appendprepend']) !!}
                                <span class="input-group-addon">.00</span>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tujangan<br>{{$tunjangan->status}} <?php if ($tunjangan->jumlah_anak == 0) {} else{echo 'jumlah anak '.$tunjangan->jumlah_anak;} ?></td>
                            <td>
                            <div class="input-group">
                            <span class="input-group-addon">Rp.</span>
                                <?php $tunjangan->besaran_uang = number_format($tunjangan->besaran_uang,2,',','.'); ?>
                                {!! Form::label('besaran_uang',$tunjangan->besaran_uang,['class'=>'form-control','id'=>'appendprepend']) !!}
                                <span class="input-group-addon">.00</span>
                            </div>
                            </td>
                        </tr>
                        @if(isset($lemburs))
                        <tr>
                            <td>Jumlah Jam Lembur</td>
                            <td>
                            <div class="input-group">
                                {!! Form::label('',$data->jumlah_jam_lembur,['class'=>'form-control','style'=>'text-align:right;']) !!}
                                <span class="input-group-addon">Jam</span>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Uang Lembur</td>
                            <td>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <?php $data->jumlah_uang_lembur = number_format($data->jumlah_uang_lembur,2,',','.'); ?>
                                {!! Form::label('besaran_uang',$data->jumlah_uang_lembur,['class'=>'form-control','id'=>'appendprepend']) !!}
                                <span class="input-group-addon">.00</span>
                            </div>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td>Total Gaji</td>
                            <td>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <?php $data->total_gaji = number_format($data->total_gaji,2,',','.'); ?>
                                {!! Form::label('besaran_uang',$data->total_gaji,['class'=>'form-control','id'=>'appendprepend']) !!}
                                <span class="input-group-addon">.00</span>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Petugas Penerima</td>
                            <td>
                            {!! Form::text('petugas_penerima',Auth::user()->name,['class'=>'form-control','disabled']) !!}
                            {!! Form::hidden('petugas_penerima',Auth::user()->name,['class'=>'form-control']) !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">
                                {!! Form::submit('Ok',['class'=>'btn btn-primary']) !!}
                            </td>
                        </tr>
                    </table>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
