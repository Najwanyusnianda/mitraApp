<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik')->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone',15)->nullable();
            $table->date('tanggal_lahir');
            $table->text('pengalaman')->nullable();
            $table->text('pekerjaan');
            $table->string('pendidikan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('desa')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('is_kawin')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('npwp')->nullable();
            $table->boolean('is_gadget')->nullable()->default(false);
            $table->boolean('is_kendaraan')->nullable()->default(false);
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
        Schema::dropIfExists('mitras');
    }
}
