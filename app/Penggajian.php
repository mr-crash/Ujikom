<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
	protected $table = 'penggajians';
	protected $fillable = ['id','tunjangan_pegawai_id','jumlah_jam_lembur','jumlah_uang_lembur','gaji_pokok','total_gaji','status_pengambilan','created_at','updated_at'];
	protected $nullabel = ['tanggal_pengambilan','petugas_penerima'];
	public $timestamps = true;

	public function tunjangan_pegawai(){
		return $this->belongsTo('App\TunjanganPegawai','tunjangan_pegawai_id');
	}
}
