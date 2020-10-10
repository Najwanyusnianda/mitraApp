<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanMitrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_mitras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedInteger('mitra_id');
            $table->unsignedInteger('nilai_pelatihan1')->nullable();
            $table->unsignedInteger('nilai_pelatihan2')->nullable();
            $table->unsignedInteger('nilai_pelatihan3')->nullable();
            $table->float('avg_pelatihan',8,2)->nullable();
            $table->unsignedInteger('nilai_pelaksanaan1')->nullable();
            $table->unsignedInteger('nilai_pelaksanaan2')->nullable();
            $table->unsignedInteger('nilai_pelaksanaan3')->nullable();
            $table->float('avg_pelaksanaan',8,2)->nullable();
            $table->unsignedInteger('nilai_evaluasi1')->nullable();
            $table->unsignedInteger('nilai_evaluasi2')->nullable();
            $table->unsignedInteger('nilai_evaluasi3')->nullable();
            $table->float('avg_evaluasi',8,2)->nullable();
            $table->float('total_nilai',8,2)->nullable();
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
        Schema::dropIfExists('kegiatan_mitras');
    }
}
