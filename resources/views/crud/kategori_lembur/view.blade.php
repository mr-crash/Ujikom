<?php $page = 'ID Kategori Lembur '.$data->id ?>
<?php $root = 'kategori_lembur' ?>
@extends('layouts.app')

@section('footer')
<a href="{{url('kategori_lembur')}}">Kategori Lembur</a> > <a href="{{url('kategori_lembur',$data->id)}}">{{$data->kode_lembur}}</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$page}}</div>

                <div class="panel-body">
                	<table class="table">
                		<tr>
                			<td>{!! Form::label('Kode') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('kode_lembur') ? ' has-error' : '' }}">
                			{!! Form::label('kode_lembur',$data->kode_lembur,['class'=>'form-control']) !!}
                			</div>
                        	@if ($errors->has('kode_lembur'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('kode_lembur') }}</strong>
	                            </span>
                        	@endif
                        </td>
                		</tr>
                        <tr>
                            <td>{!! Form::label('Jabatan') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('jabatan_id') ? ' has-error' : '' }}">
                            {!! Form::label('data',$data->jabatan->nama_jabatan,['class'=>'form-control']) !!}
                            </div>
                            @if ($errors->has('jabatan_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jabatan_id') }}</strong>
                                </span>
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{!! Form::label('golongan') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('golongan_id') ? ' has-error' : '' }}">
                            {!! Form::label('data',$data->golongan->nama_golongan,['class'=>'form-control']) !!}
                            </div>
                            @if ($errors->has('golongan_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('golongan_id') }}</strong>
                                </span>
                            @endif
                            </td>
                        </tr>
                		<tr>
                			<td>{!! Form::label('Besaran uang') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('besaran_uang') ? ' has-error' : '' }}">
                			<div class="input-group">
								<span class="input-group-addon">Rp.</span>
                                <?php $data->besaran_uang = number_format($data->besaran_uang,0,',','.'); ?>
								{!! Form::label('besaran_uang',$data->besaran_uang,['class'=>'form-control','id'=>'appendprepend']) !!}
								<span class="input-group-addon">.00</span>
							</div>
                			</div>
                        	@if ($errors->has('besaran_uang'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('besaran_uang') }}</strong>
	                            </span>
                        	@endif
							</td>
                		</tr>
                        <tr>
                            <td colspan="9" align="center">
                                {!! Form::open(['method'=> 'DELETE', 'route'=>['kategori_lembur.destroy',$data->id]]) !!}
                                <a href="{{route('kategori_lembur.edit',$data->id)}}" class="btn btn-warning" style="width: 49%;">Edit</a>
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger','style'=>'width:49%;']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @if (isset($pegawais->first()->id))
                        <tr>
                            <td>Daftar Pegawai</td>
                            <td>
                                <table class="table">
                                @foreach($pegawais as $pegawai)
                                <tr>
                                    <td>{{$pegawai->nip}}</td>
                                    <td>{{$pegawai->user->name}}</td>
                                </tr>
                                @endforeach
                                </table>
                            </td>
                        </tr>
                        @endif
                	</table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
