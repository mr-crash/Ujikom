<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
	protected $table = 'jabatans';
	protected $fillable = ['id','kode_jabatan','nama_jabatan','tunjangan_uang','created_at','updated_at'];
	public $timestamps = true;

	public function pegawai(){
		return $this->hasMany('App\Pegawai','jabatan_id');
	}
}
