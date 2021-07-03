<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId("santri_nisn");
            $table->string('dzikir_pagi');
            $table->string('dzikir_petang');
            $table->string('subuh');
            $table->string('dzuhur');
            $table->string('ashar');
            $table->string('maghrib');
            $table->string('isya');
            $table->string('baca_alquran');
            $table->date('tanggal_kegiatan');
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
        Schema::dropIfExists('kegiatan');
    }
}
