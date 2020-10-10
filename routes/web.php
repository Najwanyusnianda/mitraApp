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






Route::group(['middleware' => ['auth']], function () {
    Route::group(['layout' => 'master', 'section' => 'content'], function () {
    
    //dashboard
    //Route::livewire('/dashboard','dashboard-index');
    
    
    Route::livewire('/', 'dashboard-index');
    //kegiatan
    Route::livewire('/kegiatan/index','kegiatan-index');
    Route::livewire('/kegiatan/create','kegiatan-create');

    //mitra
    //Route::livewire('/mitra/create/{id}','mitra-create');
    Route::livewire('/mitra/kegiatan', 'mitra-index');
    Route::livewire('/mitra/db', 'mitra-list');
   // Route::livewire('/penilaian/{kegiatan_id}/{mitra_id}', 'mitra-penilaian-create');

   //user
   Route::livewire('/user/index','user.user-index');
   
   //output
    Route::get('/output/sertifikat/{kegiatan_id}/{mitra_id}','OutputController@getSertifikat');
    Route::get('/output/kontrak/{kegiatan_id}/{mitra_id}','OutputController@getSpk');
    Route::get('/output/spj/{kegiatan_id}/{mitra_id}','OutputController@getSpj');

    });
});

Auth::routes();

#Route::get('/home', 'HomeController@index')->name('home');
