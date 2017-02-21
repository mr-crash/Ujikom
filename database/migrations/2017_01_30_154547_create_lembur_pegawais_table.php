<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLemburPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur_pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kategori_lembur_id')->unsigned();
            $table->foreign('kategori_lembur_id')->references('id')->on('kategori_lemburs')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('pegawai_id')->unsigned();
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_jam');
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
        Schema::dropIfExists('lembur_pegawais');
    }
}
