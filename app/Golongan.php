<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
	protected $table = 'golongans';
	protected $fillable = ['id','kode_golongan','nama_golongan','tunjangan_uang','created_at','updated_at'];
	public $timestamps = true;
}
