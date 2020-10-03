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
    
    //dashboard
    Route::livewire('/dashboard','dashboard-index');
    
    //mitra
    Route::livewire('/', 'kegiatan-index');
    Route::livewire('/kegiatan/create','kegiatan-create');
    Route::livewire('/mitra/create/{id}','mitra-create');
    Route::livewire('/kegiatan/mitra', 'mitra-index');
   // Route::livewire('/penilaian/{kegiatan_id}/{mitra_id}', 'mitra-penilaian-create');
    

});