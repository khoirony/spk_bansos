<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerbobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terbobots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_warga')->unsigned();
            $table->foreignId('id_kriteria')->unsigned();
            $table->foreignId('id_periode')->unsigned();
            $table->double('nilai_normalisasi', 15, 8)->nullable();
            $table->timestamps();

            $table->foreign('id_warga')->references('id')->on('wargas');
            $table->foreign('id_kriteria')->references('id')->on('kriterias');
            $table->foreign('id_periode')->references('id')->on('periodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terbobots');
    }
}
