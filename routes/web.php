<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/







Route::group(['layout' => 'master', 'section' => 'content'], function () {
    //
    Route::livewire('/', 'kegiatan-index');

    Route::livewire('/kegiatan/{kegiatan_id}', 'mitra-index');


});