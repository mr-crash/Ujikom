<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TunjanganPegawai extends Model
{
	protected $table = 'tunjangan_pegawais';
	protected $fillable = ['id','kode_tunjangan_id','pegawai_id','created_at','updated_at'];
	public $timestamps = true;

	public function tunjangan(){
		return $this->belongsTo('App\Tunjangan','kode_tunjangan_id');
	}
	public function pegawai(){
		return $this->belongsTo('App\Pegawai','pegawai_id');
	}
}
