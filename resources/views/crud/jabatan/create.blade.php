<?php $page = 'Create Jabatan' ?>
<?php $root = 'jabatan' ?>
@extends('layouts.'.config('app.layout'))

@section('footer')
<a href="{{url('jabatan')}}">Jabatan</a> > <a href="{{url('jabatan','create')}}">Create</a>
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
                            <?php $random = rand(111111,999999); ?>
                    <table class="table">
                        <tr>
                        <td>{!! Form::label('Kode') !!}</td>
                        <td>
                            {!! Form::label('kode_jabatan','J-'.$random,['class'=>'form-control','disabled']) !!}
                            {!! Form::hidden('kode_jabatan','J-'.$random,['class'=>'form-control']) !!}
                            <div class="form-group{{ $errors->has('kode_jabatan') ? ' has-error' : '' }}">
                			</div>
                        	@if ($errors->has('kode_jabatan'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('kode_jabatan') }}</strong>
	                            </span>
                        	@endif
                        </td>
                		</tr>
                		<tr>
                			<td>{!! Form::label('Nama') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('nama_jabatan') ? ' has-error' : '' }}">
                			{!! Form::text('nama_jabatan',null,['class'=>'form-control','autofocus']) !!}
                			</div>
                        	@if ($errors->has('nama_jabatan'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('nama_jabatan') }}</strong>
	                            </span>
                        	@endif
                        	</td>
                		</tr>
                		<tr>
                			<td>{!! Form::label('Tunjangan Uang') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('tunjangan_uang') ? ' has-error' : '' }}">
                			<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								{!! Form::number('tunjangan_uang',null,['class'=>'form-control','id'=>'appendprepend']) !!}
								<span class="input-group-addon">.00</span>
							</div>
                			</div>
                        	@if ($errors->has('tunjangan_uang'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('tunjangan_uang') }}</strong>
	                            </span>
                        	@endif
							</td>
                		</tr>
                		<tr>
                			<td colspan="2" align="right">{!! Form::submit('Create',['class'=>'btn btn-success']) !!}</td>
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
