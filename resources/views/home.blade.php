@extends('layouts.'.config('app.layout'))

@section('content')
<div class="container">
<?php 
 ?>
@if(isset($pegawais->where('user_id',Auth::user()->id)->first()->id))
<?php 
	$pegawai = $pegawais->where('user_id',Auth::user()->id)->first();
	$gajipokok = number_format($pegawai->jabatan->tunjangan_uang+$pegawai->golongan->tunjangan_uang,2,',','.');
	$gajigolongan = number_format($pegawai->golongan->tunjangan_uang,2,',','.');
	$gajijabatan = number_format($pegawai->jabatan->tunjangan_uang,2,',','.');
	$lemburs = $lemburs->where('pegawai_id',$pegawai->id);
	// dd($gajis);
 ?>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" align="center">
					<img class="foto-profile" style="background-image: url({{url('account',$pegawai->foto)}})">
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
						<td>{!! Form::label('',$pegawai->jabatan->nama_jabatan,['class'=>'form-control']) !!}</td>
					</tr>
					<tr>
						<td>Golongan</td>
						<td>{!! Form::label('',$pegawai->golongan->nama_golongan,['class'=>'form-control']) !!}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title"></div>
			</div>
			<div class="panel-body">
				<h3>Gaji Pegawai</h3><hr>
				<table class="table">
					<tr>
						<td>Jabatan</td>
						<td>{!! Form::label('',$pegawai->jabatan->nama_jabatan) !!}</td>
						<td><div class="input-group">
								<span class="input-group-addon">Rp.</span>
								{!! Form::label('tunjangan_uang',$gajijabatan,['class'=>'form-control','id'=>'appendprepend']) !!}
							</div></td>
					</tr>
					<tr>
						<td>Golongan</td>
						<td>{!! Form::label('',$pegawai->golongan->nama_golongan) !!}</td>
						<td><div class="input-group">
								<span class="input-group-addon">Rp.</span>
								{!! Form::label('tunjangan_uang',$gajigolongan,['class'=>'form-control','id'=>'appendprepend']) !!}
							</div></td>
					</tr>
					<tr>
						<td>Gaji Pokok</td>
						<td>{!! Form::label('',$pegawai->jabatan->nama_jabatan) !!}</td>
						<td><div class="input-group">
								<span class="input-group-addon">Rp.</span>
								{!! Form::label('',$gajipokok,['class'=>'form-control']) !!}
							</div></td>
					</tr>
				</table>
				@if(isset($pegawai->tunjangan_pegawai->kode_tunjangan_id))
				@if(isset($gajis->where('tunjangan_pegawai_id',$pegawai->tunjangan_pegawai->kode_tunjangan_id)->first()->id))
				<h4>Riwayat gaji</h4><hr>
	<?php $gajis = $gajis->where('tunjangan_pegawai_id',$pegawai->tunjangan_pegawai->kode_tunjangan_id); ?>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th rowspan="2">Tanggal</th>
							<th colspan="2">Lembur</th>
							<th rowspan="2">Total Gaji</th>
							<th rowspan="2">Status Pengambilan</th>
						</tr>
						<tr>
							
							<th>Jumlah Jam</th>
							<th>Besar Uang</th>
						</tr>
					</thead>
					<tbody>
						@foreach($gajis as $gaji)
							<tr>
								<td>{{$gaji->created_at->format('l\\, j F Y')}}</td>
								<td>{{$gaji->jumlah_jam_lembur}}</td>
								<td>{{number_format($gaji->jumlah_uang_lembur,2,',','.')}}</td>
								<td>{{number_format($gaji->total_gaji,2,',','.')}}</td>
								@if($gaji->status_pengambilan == 0)
								<td class="danger">Belum Diambil</td>
								@elseif($gaji->status_pengambilan == 1)
								<td class="success">Sudah Diambil</td>
								@endif
								</tr>
						@endforeach
					</tbody>					
				</table>
				@endif
				@endif
				@if(isset($lemburs->first()->id))
				<h4>Riwayat Lembur</h4><hr>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Jumlah Jam</th>
							<th>Jumlah Uang</th>
						</tr>
					</thead>
					@foreach($lemburs as $lembur)
					<tbody>
						<tr>
							<td>{{$lembur->created_at->format('l\\, j F Y')}}</td>
							<td>{{$lembur->jumlah_jam}}</td>
							<td>{{$lembur->jumlah_jam*$lembur->kategori_lembur->besaran_uang}}</td>
						</tr>
					</tbody>
					@endforeach
				</table>
				@endif
			</div>
		</div>
	</div>
</div>
</div>
@else
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">You are a Robot</div>
                <div class="panel-body">
Robot adalah seperangkat alat mekanik yang bisa melakukan tugas fisik, baik dengan pengawasan dan kontrol manusia, ataupun menggunakan program yang telah didefinisikan terlebih dulu (kecerdasan buatan). Istilah robot berawal bahasa Ceko “robota” yang berarti pekerja atau kuli yang tidak mengenal lelah atau bosan. Robot biasanya digunakan untuk tugas yang berat, berbahaya, pekerjaan yang berulang dan kotor. Biasanya kebanyakan robot industri digunakan dalam bidang produksi. Penggunaan robot lainnya termasuk untuk pembersihan limbah beracun, penjelajahan bawah air dan luar angkasa, pertambangan, pekerjaan "cari dan tolong" (search and rescue), dan untuk pencarian tambang. Belakangan ini robot mulai memasuki pasaran konsumen di bidang hiburan, dan alat pembantu rumah tangga, seperti penyedot debu, dan pemotong rumput.

Saat ini hampir tidak ada orang yang tidak mengenal robot, namun pengertian robot tidaklah dipahami secara sama oleh setiap orang. Sebagian membayangkan robot adalah suatu mesin tiruan manusia (humanoid), meski demikian humanoid bukanlah satu-satunya jenis robot.

Pada kamus Webster pengertian robot adalah

An automatic device that performs function ordinarily ascribed to human beings
(sebuah alat otomatis yang melakukan fungsi berdasarkan kebutuhan manusia)
Dari kamus Oxford diperoleh pengertian robot adalah:

A machine capable of carrying out a complex series of actions automatically, especially one programmed by a computer.
(Sebuah mesin yang mampu melakukan serangkaian tugas rumit secara otomatis, terutama yang diprogram oleh komputer)
Pengertian dari Webster mengacu pada pemahaman banyak orang bahwa robot melakukan tugas manusia, sedangkan pengertian dari Oxford lebih umum.

Beberapa organisasi di bidang robot membuat definisi tersendiri. Robot Institute of America memberikan definisi robot sebagai:

A reprogammable multifunctional manipulator designed to move materials, parts, tools or other specialized devices through variable programmed motions for the performance of a variety of tasks
(Sebuah manipulator multifungsi yang mampu diprogram, didesain untuk memindahkan material, komponen, alat, atau benda khusus lainnya melalui serangkaian gerakan terprogram untuk melakukan berbagai tugas)
International Organization for Standardization (ISO 8373) mendefinisikan robot sebagai:

An automatically controlled, reprogrammable, multipurpose, manipulator programmable in three or more axes, which may be either fixed in place or mobile for use in industrial automation applications
(Sebuah manipulator yang terkendali, multifungsi, dan mampu diprogram untuk bergerak dalam tiga aksis atau lebih, yang tetap berada di tempat atau bergerak untuk digunakan dalam aplikasi otomasi industri)
Dari beberapa definisi di atas, kata kunci yang ada yang dapat menerangkan pengertian robot adalah:

Dapat memperoleh informasi dari lingkungan (melalui sensor)
Dapat diprogram
Dapat melaksanakan beberapa tugas yang berbeda
Bekerja secara otomatis
Cerdas (intelligent)
Digunakan di industri
	                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
