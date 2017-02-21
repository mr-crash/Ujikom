<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LemburPegawai extends Model
{
	protected $table = 'lembur_pegawais';
	protected $fillable = ['id','kategori_lembur_id','pegawai_id','jumlah_jam','created_at','update_at'];
	public $timestamps = true;

	public function pegawai(){
		return $this->belongsTo('App\Pegawai','pegawai_id');
	}
	public function kategori_lembur(){
		return $this->belongsTo('App\KategoriLembur','kategori_lembur_id');
	}
}
