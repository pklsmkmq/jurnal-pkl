<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPembimbingLapanganColumnsToSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('santri', function (Blueprint $table) {
            $table->integer('pembimbing_lapangan_1')
                    ->after('pembimbing_id');
            $table->integer('pembimbing_lapangan_2')
                    ->after('pembimbing_id');
            $table->integer('angkatan')
                    ->after('pembimbing_lapangan_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('santri', function (Blueprint $table) {
            $table->dropColumn('pembimbing_lapangan_1', 'pembimbing_lapangan_2', 'angkatan');
        });
    }
}
