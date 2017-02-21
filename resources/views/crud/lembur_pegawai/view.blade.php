<?php $page = 'ID Lembur '.$data->id ?>
<?php $root = 'lembur_pegawai' ?>
@extends('layouts.app')

@section('footer')
<a href="{{url($root)}}">Lembur Pegawai</a> > <a href="{{url($root,$data->id)}}">{{$data->kode_lembur}}</a>
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
                			<div class="form-group">
                			{!! Form::label('kode',$data->kode_lembur,['class'=>'form-control']) !!}
                			</div>
                        </td>
                		</tr>
                        <tr>
                            <td>{!! Form::label('Kategori Lembur') !!}</td>
                            <td>{!! Form::label('',$data->kategori_lembur->kode_lembur,['class'=>'form-control']) !!}</td>
                        </tr>
                		<tr>
                			<td>{!! Form::label('Pegawai') !!}</td>
                			<td>
                			<div class="form-group">
                			{!! Form::label('pegawai',$users->where('id',$data->pegawai->user_id)->first()->name,['class'=>'form-control']) !!}
                			</div>
                        	</td>
                		</tr>
                		<tr>
                			<td>{!! Form::label('Jumlah Jam') !!}</td>
                			<td>
                			<div class="form-group">
                			<div class="input-group">
								{!! Form::label('jumlah_jam',$data->jumlah_jam,['class'=>'form-control','id'=>'appendprepend']) !!}
								<span class="input-group-addon">Jam</span>
							</div>
                			</div>
							</td>
                		</tr>
                        <tr>
                            <td colspan="9" align="center">
                                {!! Form::open(['method'=> 'DELETE', 'route'=>['lembur_pegawai.destroy',$data->id]]) !!}
                                <a href="{{route('lembur_pegawai.edit',$data->id)}}" class="btn btn-warning" style="width: 49%;">Edit</a>
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger','style'=>'width:49%;']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                	</table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
