<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kegiatan');
            $table->year('tahun');
            $table->text('deskripsi');
            $table->date('pelatihan_mulai')->nullable();
            $table->date('pelatihan_selesai')->nullable();
            $table->date('pelaksanaan_mulai')->nullable();
            $table->date('pelaksanaan_selesai')->nullable();
            $table->text('template_sertifikat_path')->nullable();
            $table->text('template_spk_path')->nullable();
            $table->boolean('is_active')->default(true)->nullable();
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
        Schema::dropIfExists('kegiatans');
    }
}
