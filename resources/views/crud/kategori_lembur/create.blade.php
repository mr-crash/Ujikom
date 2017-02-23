<?php $page = 'Create Kategori Lembur' ?>
<?php $root = 'kategori_lembur' ?>
@extends('layouts.'.config('app.layout'))

@section('footer')
<a href="{{url('kategori_lembur')}}">Kategori Lembur</a> > <a href="{{url('kategori_lembur','create')}}">Create</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$page}}</div>

                <div class="panel-body">
                	{!! Form::open(['url'=>$root]) !!}
                    <?php $random = rand('111111','999999'); ?>
                    {{ csrf_field() }}
                    <table class="table">
                        <tr>
                            <td>{!! Form::label('Kode Kategori Lembur') !!}</td>
                            <td>
                            {!! Form::label('kode_lembur','KL-'.$random,['class'=>'form-control','disabled']) !!}
                			{!! Form::hidden('kode_lembur','KL-'.$random,['class'=>'form-control']) !!}
                            <div class="form-group{{ $errors->has('kode_lembur') ? ' has-error' : '' }}">
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
                            @if(!isset($jabatans->first()->id))
                            <div class="col-md-12 btn btn-danger disabled">Mohon untuk mengisi data jabatan terlebih dahulu</div>
                            @else
                            <div class="form-group{{ $errors->has('jabatan_id') ? ' has-error' : '' }}">
                            <select name="jabatan_id" class="form-control">
                                <option value="">List Jabatan</option>
                                @foreach ($jabatans as $data)
                                <option value="{{$data->id}}">{{$data->nama_jabatan}}</option>
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
                            <td>{!! Form::label('golongan') !!}</td>
                            <td>
                            @if(!isset($golongans->first()->id))
                            <div class="col-md-12 btn btn-danger disabled">Mohon untuk mengisi data golongan terlebih dahulu</div>
                            @else
                            <div class="form-group{{ $errors->has('golongan_id') ? ' has-error' : '' }}">
                            <select name="golongan_id" class="form-control">
                                <option value="">List Golongan</option>
                                @foreach ($golongans as $data)
                                <option value="{{$data->id}}">{{$data->nama_golongan}}</option>
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
                        @if(isset($_GET['errors_unique']))
                        <tr>
                            <td colspan="999" class="danger">
                                <span class="help-block">
                                    <strong>Pegawai dan Golongan yang sama sudah tedatar<br>silahkan check  <a href="{{url($_GET['url'])}}">disini</a></strong>
                                </span>
                            </td>
                        </tr>
                        @endif
                		<tr>
                			<td>{!! Form::label('Besaran uang') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('besaran_uang') ? ' has-error' : '' }}">
                			<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								{!! Form::number('besaran_uang',null,['class'=>'form-control','id'=>'appendprepend']) !!}
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
                			<td colspan="2" align="right">
                            @if(!isset($jabatans->first()->id)||!isset($golongans->first()->id))
                            {!! Form::submit('Create',['class'=>'btn btn-success','disabled']) !!}
                            @else
                            {!! Form::submit('Create',['class'=>'btn btn-success']) !!}
                            @endif
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
