<?php $page = 'View Kategori Tunjangan' ?>
<?php $root = 'tunjangan' ?>
@extends('layouts.app')

@section('footer')
<a href="{{url('tunjangan')}}">Tunjangan</a> > <a href="{{url('tunjangan',$data->id)}}">View</a>
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
                            <div class="form-group{{ $errors->has('kode_tunjangan') ? ' has-error' : '' }}">
                            {!! Form::label('kode_tunjangan',$data->kode_tunjangan,['class'=>'form-control']) !!}
                            </div>
                            @if ($errors->has('kode_tunjangan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kode_tunjangan') }}</strong>
                                </span>
                            @endif
                        </td>
                        </tr>
                        <tr>
                            <td>{!! Form::label('Jabatan') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('jabatan_id') ? ' has-error' : '' }}">
                            <select name="jabatan_id" class="form-control" disabled="">
                                <option>{{$data->jabatan->nama_jabatan}}</option>
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
                            <select name="golongan_id" class="form-control" disabled="">
                                <option>{{$data->golongan->nama_golongan}}</option>
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
                            <td>{!! Form::label('Status') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {!! Form::label('status',$data->status,['class'=>'form-control']) !!}
                            </div>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{!! Form::label('Jumlah Anak') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('jumlah_anak') ? ' has-error' : '' }}">
                            {!! Form::label('jumlah_anak',$data->jumlah_anak,['class'=>'form-control']) !!}
                            </div>
                            @if ($errors->has('jumlah_anak'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jumlah_anak') }}</strong>
                                </span>
                            @endif
                            </td>
                        </tr>
                        <tr>
                        </tr>
                		<tr>
                			<td>{!! Form::label('Besar Uang') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('besaran_uang') ? ' has-error' : '' }}">
                			<div class="input-group">
                                <?php $data->besaran_uang = number_format($data->besaran_uang,0,',','.'); ?>
								<span class="input-group-addon">Rp.</span>
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
                			<td class="action-web" colspan="2" align="center"><a href="{{route('tunjangan.edit',$data->id)}}" class="btn-block btn btn-warning ">Edit</a>{!! Form::open(['method'=> 'DELETE', 'route'=>['tunjangan.destroy',$data->id]]) !!}
                            {!! Form::submit('Delete', ['class'=>'btn-block btn btn-danger lebar']) !!}
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
