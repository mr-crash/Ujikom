<?php $page = 'Create Lembur' ?>
<?php $root = 'lembur_pegawai' ?>
@extends('layouts.'.config('app.layout'))

@section('footer')
<a href="{{url($root)}}">Lembur Pegawai</a> > <a href="{{url($root,'create')}}">Create</a>
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
                        <tr>
                            <td>{!! Form::label('Pegawai') !!}</td>
                            <td>
                            @if(!isset($pegawais->first()->id))
                            <div class="col-md-12 btn btn-danger disabled">Table Pegawai is Null</div>
                            @else
                            <div class="form-group{{ $errors->has('pegawai_id') ? ' has-error' : '' }}">
                            <select class="form-control" name="pegawai_id" autofocus="">
                                <option></option>
                                @foreach($pegawais as $pegawai)
                                <option value="{{$pegawai->id}}">{{$pegawai->user->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            @if ($errors->has('pegawai_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pegawai_id') }}</strong>
                                </span>
                            @endif
                            @if (isset($error_klnf))
                            <div style="width: 100%;color: red;text-align: center;">
                                Pegawai ini tidak memiliki kategori lembur, silahkan untuk membuat kategori <a href="{{url('kategori_lembur','create')}}">disini</a>
                            </div>
                            @endif
                            @endif
                            </td>
                        </tr>
                		<tr>
                			<td>{!! Form::label('Jumlah Jam') !!}</td>
                			<td>
                			<div class="form-group{{ $errors->has('jumlah_jam') ? ' has-error' : '' }}">
                			<div class="input-group">
								{!! Form::number('jumlah_jam',null,['class'=>'form-control','id'=>'appendprepend','style'=>'text-align:right;']) !!}
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
                			<td colspan="2" align="right">
                            @if(!isset($pegawais->first()->id))
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
