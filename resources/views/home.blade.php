@extends('layouts.app')

@section('content')
<div class="container">
@if(Auth::user()->type_user == 'pegawai')
<?php 
	$pegawai = $pegawais->where('user_id',Auth::user()->id)->first();
 ?>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					
				</div>
			</div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td>NIP</td>
						<td>{!! Form::label('',$pegawai->nip,['class'=>'form-control']) !!}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>{!! Form::label('',$pegawai->user->name,['class'=>'form-control']) !!}</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>{!! Form::label('',$pegawai->user->email,['class'=>'form-control']) !!}</td>
					</tr>
					<tr>
						<td>Jabatan</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@else
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
