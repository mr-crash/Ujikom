<?php $page = 'Update Lembur' ?>
<?php $root = 'lembur_pegawai' ?>
@extends('layouts.app')

@section('footer')
<a href="{{url($root)}}">Lembur Pegawai</a> > <a href="{{url($root,$data->id.'/edit')}}">Update</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$page}}</div>

                <div class="panel-body">
                    {!! Form::model($data,(['method'=>'PATCH','route'=>['lembur_pegawai.update',$data->id]])) !!}
                    {{ csrf_field() }}
                	<table class="table">
                		<tr>
                			<td>{!! Form::label('Kode') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('kode_lembur') ? ' has-error' : '' }}">
                			{!! Form::text('kode_lembur',$data->kode_lembur,['class'=>'form-control','autofocus','placeholder'=>'L_']) !!}
                			</div>
                        	@if ($errors->has('kode_lembur'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('kode_lembur') }}</strong>
	                            </span>
                        	@endif
                        </td>
                		</tr>
                        <tr>
                            <td>{!! Form::label('Pegawai') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('pegawai_id') ? ' has-error' : '' }}">
                            <select class="form-control" name="pegawai_id">
                                <option></option>
                                @foreach($pegawais as $pegawai)
                                <option value="{{$pegawai->id}}" <?php if ($data->pegawai_id==$pegawai->id) {echo "selected";} ?>>{{$pegawai->user->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            @if ($errors->has('pegawai_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pegawai_id') }}</strong>
                                </span>
                            @endif
                            @if (isset($_GET['error']))
                            <div style="width: 100%;color: red;text-align: center;">
                                Pegawai ini tidak memiliki kategori lembur, silahkan untuk membuat kategori <a href="{{url('kategori_lembur','create')}}">disini</a>
                            </div>
                            @endif
                            </td>
                        </tr>
                		<tr>
                			<td>{!! Form::label('Jumlah Jam') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('jumlah_jam') ? ' has-error' : '' }}">
                			<div class="input-group">
								{!! Form::number('jumlah_jam',$data->jumlah_jam,['class'=>'form-control','id'=>'appendprepend','style'=>'text-align:right;']) !!}
								<span class="input-group-addon">Jam</span>
							</div>
                			</div>
                        	@if ($errors->has('jumlah_jam'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('jumlah_jam') }}</strong>
	                            </span>
                        	@endif
							</td>
                		</tr>
                		<tr>
                			<td colspan="2" align="right">{!! Form::submit('Edit',['class'=>'btn btn-warning']) !!}</td>
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
