<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunjunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId("pembimbing_id");
            $table->date('tanggal_kunjungan');
            $table->string('foto_dokumentasi_kunjungan');
            $table->text('keterangan_kunjungan');
            $table->string('nama_perusahaan_kunjungan');
            $table->integer('kunjungan_ke');
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
        Schema::dropIfExists('kunjungan');
    }
}
