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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

//URL::forceRootUrl('https://webapps.bps.go.id/subulussalamkota/');
//URL::forceScheme('https');


//Route::get('/sert','SertifikatController@index');


Route::get('dashboard','DashboardController@index');
Route::post('dashboard','DashboardController@postDashboard')->name('post.dashboard');
Route::get('get_mitra/{kegiatan_id}','DashboardController@MitraDetail')->name('get_mitra');
Route::get('get_mitraNilai/{kegiatan_id}','DashboardController@MitraDetailNilai')->name('get_mitra_nilai');
Route::get('/', function () {
        return redirect('/dashboard');
        
    });
Route::group(['middleware' => ['auth']], function () {
    Route::group(['layout' => 'master', 'section' => 'content'], function () {
    
    //dashboard
    //Route::livewire('/dashboard','dashboard-index');
    
    
    //Route::livewire('/dashboard', 'dashboard-index');
    Route::get('home', function () {
        return redirect('/dashboard');
        
    });


    
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
    Route::get('/output/bulk-sertifikat/{kegiatan_id}','OutputController@getBulk');
    Route::get('/output/bulk-spk/{kegiatan_id}','OutputController@getBulkSPK');
    Route::get('/output/kontrak/{kegiatan_id}/{mitra_id}','OutputController@getSpk');
    Route::get('/output/spj/{kegiatan_id}','OutputController@getSpj');

    });
});


Auth::routes();

#Route::get('/home', 'HomeController@index')->name('home');
//Clear configurations:
Route::get('/config-clear', function() {
    $status = Artisan::call('config:clear');
    return '<h1>Configurations cleared</h1>';
});

//Clear cache:
Route::get('/cache-clear', function() {
    $status = Artisan::call('cache:clear');
    return '<h1>Cache cleared</h1>';
});

//Clear configuration cache:
Route::get('/config-cache', function() {
    $status = Artisan::call('config:Cache');
    return '<h1>Configurations cache cleared</h1>';
});

Route::get('/storage-link', function() {
    $status = Artisan::call('storage:link');
    return '<h1>storage:link</h1>';
});

Route::get('/migrate', function() {
    $status = Artisan::call('migrate:fresh --seed');
    return '<h1>migrate</h1>';
});
Route::get('/flare', function() {
    $status = Artisan::call('vendor:publish --tag=flare-config');
    return '<h1>migrateflare</h1>';
});

