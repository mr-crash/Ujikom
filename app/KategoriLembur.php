<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriLembur extends Model
{
	protected $table = 'kategori_lemburs';
	protected $fillable = ['id','kode_lembur','jabatan_id','golongan_id','besaran_uang','created_at','updated_at'];
	public $timestamps = true;

	public function jabatan(){
		return $this->belongsTo('App\Jabatan','jabatan_id');
	}
	public function golongan(){
		return $this->belongsTo('App\Golongan','golongan_id');
	}
}
