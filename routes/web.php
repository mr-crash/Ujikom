<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	// if (Auth::user()) {
	// 	return view('home');
	// }
	// else{
	//     return view('auth.login');
	// }
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// User
Route::resource('pegawai','Crud\PegawaiController');
Route::resource('jabatan','Crud\JabatanController');
Route::resource('golongan','Crud\GolonganController');

// Lembur
Route::resource('lembur_pegawai','Crud\LemburPegawaiController');
Route::resource('kategori_lembur','Crud\KategoriLemburController');

// Tunjangan
Route::resource('tunjangan','Crud\TunjanganController');
Route::resource('tunjangan_pegawai','Crud\TunjanganPegawaiController');

// Penggajian
Route::resource('penggajian','Crud\PenggajianController');

Route::get('register', function() {return view('errors.404');});

Route::get('kronis', function() {return view('auth.register');});

