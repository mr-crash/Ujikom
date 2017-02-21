<?php $page = 'Update Kategori Lembur' ?>
<?php $root = 'kategori_lembur' ?>
@extends('layouts.app')

@section('footer')
<a href="{{url($root)}}">Kategori Lembur</a> > <a href="{{url($root,$data->id)}}">{{$data->kode_lembur}}</a> > <a href="{{url($root.'/'.$data->id.'/edit')}}">Edit</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$page}}</div>

                <div class="panel-body">
                    {!! Form::model($data,(['method'=>'PATCH','route'=>['kategori_lembur.update',$data->id]])) !!}
                    {{ csrf_field() }}
                    <table class="table">
                        <tr>
                            <td>{!! Form::label('Kode') !!}</td>
                            <td>
                            <div class="form-group{{ $errors->has('kode_lembur') ? ' has-error' : '' }}">
                            {!! Form::text('kode_lembur',null,['class'=>'form-control']) !!}
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
                            <select name="jabatan_id" class="form-control">
                                <option value="">List Jabatan</option>
                                @foreach ($jabatan as $jabatani)
                                <option value="{{$jabatani->id}}" <?php if ($data->jabatan_id==$jabatani->id) {echo "selected";} ?>>{{$jabatani->nama_jabatan}}</option>
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
                                <option value="">List golongan</option>
                                @foreach ($golongan as $golongani)
                                <option value="{{$golongani->id}}" <?php if ($data->golongan_id==$golongani->id) {echo "selected";} ?>>{{$golongani->nama_golongan}}</option>
                                @endforeach
                            </select>
                            </div>
                            @if ($errors->has('golongan_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('golongan_id') }}</strong>
                                </span>
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{!! Form::label('Besaran Uang') !!}</td>
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
