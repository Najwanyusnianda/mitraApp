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
            $table->boolean('is_gadget')->nullable()->default(false);
            $table->boolean('is_kendaraan')->nullable()->default(false);
            $table->string('nomor_rekening')->nullable();
            $table->string('npwp')->nullable();
        
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
