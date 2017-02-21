<?php $page = 'View Penggajian' ?>
<?php $root = 'penggajian' ?>
@extends('layouts.app')

@section('footer')
<a href="{{url($root)}}">Penggajian</a> > <a href="{{url($root,$data->id)}}">View</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body" align="center">
                    <div class="foto-profile" style="background-image: url({{url('account',$pegawai->foto)}})">
                    <div class="foto-comment"><a href="{{url('account',$pegawai->foto)}}" class="btn btn-default" style="background-color: #634338;color: #fff;">Image</a></div>
                        <!-- <img src="{{url('account',$data->foto)}}" class="fp"> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-6">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<div class="panel-title">Gaji</div>
    			</div>
    			<div class="panel-body">
    				<table class="table table-hover">
    					<tr>
    						<td>Nama</td>
    						<td>{{$pegawai->user->name}}</td>
    					</tr>
    					<tr>
    						<td>Jabatan {{$pegawai->jabatan->nama_jabatan}}</td>
    						<td>
    						<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								<?php $pegawai->jabatan->tunjangan_uang = number_format($pegawai->jabatan->tunjangan_uang,0,',','.'); ?>
								{!! Form::label('tunjangan_uang',$pegawai->jabatan->tunjangan_uang,['class'=>'form-control','id'=>'appendprepend']) !!}
								<span class="input-group-addon">.00</span>
							</div>
    						</td>
    					</tr>
    					<tr>
    						<td>Golongan {{$pegawai->golongan->nama_golongan}}</td>
    						<td>
    						<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								<?php $pegawai->golongan->tunjangan_uang = number_format($pegawai->golongan->tunjangan_uang,0,',','.'); ?>
								{!! Form::label('tunjangan_uang',$pegawai->golongan->tunjangan_uang,['class'=>'form-control','id'=>'appendprepend']) !!}
								<span class="input-group-addon">.00</span>
							</div>
    						</td>
    					</tr>
    					<tr>
    						<td>Gaji Pokok</td>
    						<td>
    						<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								<?php $data->gaji_pokok = number_format($data->gaji_pokok,0,',','.'); ?>
								{!! Form::label('besaran_uang',$data->gaji_pokok,['class'=>'form-control','id'=>'appendprepend']) !!}
								<span class="input-group-addon">.00</span>
							</div>
    						</td>
    					</tr>
    					<tr>
    						<td>Total Gaji</td>
    						<td>
    						<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								<?php $data->total_gaji = number_format($data->total_gaji,0,',','.'); ?>
								{!! Form::label('besaran_uang',$data->total_gaji,['class'=>'form-control','id'=>'appendprepend']) !!}
								<span class="input-group-addon">.00</span>
							</div>
    						</td>
    					</tr>
    					<tr>
    						<td>Tujangan<br>{{$tunjangan->status}} <?php if ($tunjangan->jumlah_anak == 0) {} else{echo 'jumlah anak '.$tunjangan->jumlah_anak;} ?></td>
    						<td>
    						<div class="input-group">
    						<span class="input-group-addon">Rp.</span>
								<?php $tunjangan->besaran_uang = number_format($tunjangan->besaran_uang,0,',','.'); ?>
								{!! Form::label('besaran_uang',$tunjangan->besaran_uang,['class'=>'form-control','id'=>'appendprepend']) !!}
								<span class="input-group-addon">.00</span>
							</div>
							</td>
    					</tr>
    					<tr>
    						<td>{!! Form::label('Status Pengambilan') !!}</td>
    						<td>
    							<?php 
                            switch ($data->status_pengambilan) {
                                case 1 :
                                    echo "<b href='#' class='btn btn-block btn-danger disabled'>Sudah Diambil</b>";
                                    break;
                                
                                case 0:
                                    echo "<a href=".url($root.'/'.$data->id.'/edit')." class='btn btn-primary'>Belum Diambil</a>";
                                    break;
                                default :
                                    break;
                            }
                             ?>
    						</td>
    					</tr>
    					@if($data->status_pengambilan==1)
    					<tr>
    						<td>Tanggal Pengambillan</td>
    						<td>{!! Form::date('',$data->tanggal_pengambilan,['class'=>'form-control','disabled']) !!}</td>
    					</tr>
    					<tr>
    						<td>Petugas Penerima</td>
    						<td>{!! Form::label('',$data->petugas_penerima,['class'=>'form-control']) !!}</td>
    					</tr>
    					@endif
    				</table>
    			</div>
    		</div>
    	</div>
    	<div class="col-md-6">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<div class="panel-title">Lembur</div>
    			</div>
    			<div class="panel-body">
	    			<table class="table table-hover">
	    				<tr>
    						<td>Jumlah Jam Lembur</td>
    						<td>
    						<div class="input-group">
								{!! Form::label('jumlah_jam',$data->jumlah_jam_lembur,['class'=>'form-control','id'=>'appendprepend','style'=>'text-align:right;']) !!}
								<span class="input-group-addon">Jam</span>
							</div>
    						</td>
    					</tr>
    					<tr>
    						<td>Jumlah Uang Lembur</td>
    						<td>
    						<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								<?php $data->jumlah_uang_lembur = number_format($data->jumlah_uang_lembur,2,',','.'); ?>
								{!! Form::label('besaran_uang',$data->jumlah_uang_lembur,['class'=>'form-control','id'=>'appendprepend']) !!}
								<span class="input-group-addon">.00</span>
							</div>
    						</td>
    					</tr>
    					<tr>
    						<td colspan="2"><h3>History Lembur</h3></td>
    					</tr>
    					<tr>
    						<td colspan="2">
    							<table class="table table-hover">
									<tr>
										<td>Tanggal</td>
										<td>Jumlah Jam</td>
										<td>Jumlah Uang</td>
									</tr>
    								@foreach($lemburs as $lembur)
    								<tr>
    									<td>{{$lembur->created_at}}</td>
    									<td>{{$lembur->jumlah_jam}}</td>
    									<td>{{$lembur->jumlah_jam*$kategori_lembur->besaran_uang}}</td>
    								</tr>
    								@endforeach
    								<tr>
    									<td colspan="99">{{$lemburs->links()}}</td>
    								</tr>
    							</table>
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
