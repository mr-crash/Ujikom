<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenggajiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggajians', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tunjangan_pegawai_id')->unsigned();
            $table->foreign('tunjangan_pegawai_id')->references('id')->on('tunjangan_pegawais')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_jam_lembur');
            $table->integer('jumlah_uang_lembur');
            $table->integer('gaji_pokok');
            $table->integer('total_gaji');
            $table->boolean('status_pengambilan')->default(0);
            $table->date('tanggal_pengambilan')->nullable();
            $table->string('petugas_penerima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggajians');
    }
}
