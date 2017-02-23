<?php $page = 'Edit Kategori Tunjangan' ?>
<?php $root = 'tunjangan' ?>
@extends('layouts.'.config('app.layout'))

@section('footer')
<a href="{{url('tunjangan')}}">Tunjangan</a> > <a href="{{url('tunjangan/'.$data->id.'/edit')}}">Edit</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$page}}</div>

                <div class="panel-body">
                    {!! Form::model($data,(['method'=>'PATCH','route'=>['tunjangan.update',$data->id]])) !!}
                    {{ csrf_field() }}
                	<table class="table">
                        <tr>
                            <td>{!! Form::label('Kode') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('kode_tunjangan') ? ' has-error' : '' }}">
                            {!! Form::text('kode_tunjangan',null,['class'=>'form-control','autofocus']) !!}
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
                            <select name="jabatan_id" class="form-control">
                                <option></option>
                                @foreach($jabatans as $jabatan)
                                <option value="{{$jabatan->id}}" <?php if ($jabatan->id==$data->jabatan_id) {echo "selected";} ?>>{{$jabatan->nama_jabatan}}</option>
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
                                <option></option>
                                @foreach($golongans as $golongan)
                                <option value="{{$golongan->id}}" <?php if ($golongan->id==$data->golongan_id) {echo "selected";} ?>>{{$golongan->nama_golongan}}</option>
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
                            <td>{!! Form::label('Status') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {!! Form::select('status',['','Sudah Menikah'=>'Sudah Menikah','Belum Menikah'=>'Belum Menikah'],null,['class'=>'form-control']) !!}
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
                            {!! Form::number('jumlah_anak',null,['class'=>'form-control']) !!}
                            </div>
                            @if ($errors->has('jumlah_anak'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jumlah_anak') }}</strong>
                                </span>
                            @endif
                            </td>
                        </tr>
                        @if(isset($_GET['errors_ilegal']))
                        <tr>
                            <td colspan="2" class="danger">Mohon isi status dengan jumlah anak dengan benar</td>
                        </tr>
                        @endif
                        <tr>
                        </tr>
                		<tr>
                			<td>{!! Form::label('Besar Uang') !!}</td>
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
                        @if(isset($_GET['errors_sama']))
                        <tr>
                            <td colspan="2" class="danger">Data Yang Anda Masukan Ada yang sama</a></td>
                        </tr>
                        @endif
                		<tr>
                			<td colspan="2" align="right">{!! Form::submit('Update',['class'=>'btn btn-warning']) !!}</td>
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
