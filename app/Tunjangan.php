<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
	protected $table = 'tunjangans';
	protected $fillable = ['id','kode_tunjangan','jabatan_id','golongan_id','status','jumlah_anak','besaran_uang','created_at','updated_at'];
	public $timestamps = true;

	public function jabatan(){
		return $this->belongsTo('App\Jabatan','jabatan_id');
	}

	public function golongan(){
		return $this->belongsTo('App\Golongan','golongan_id');
	}
}
