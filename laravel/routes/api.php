<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\TagihanController;
use App\Http\Middleware\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function ($router) {
    Route::get('menu', 'MenuController@index');

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register', 'AuthController@register');

    // Route::resource('notes', 'NotesController');

    // Route::resource('resource/{table}/resource', 'ResourceController');

    Route::group(['middleware' => 'admin'], function ($router) {

        // Route::resource('mail',        'MailController');
        // Route::get('prepareSend/{id}', 'MailController@prepareSend')->name('prepareSend');
        // Route::post('mailSend/{id}',   'MailController@send')->name('mailSend');

        // Route::resource('bread',  'BreadController');   //create BREAD (resource)

        // Route::resource('users', 'UsersController')->except(['create', 'store']);

        // Route::prefix('menu/menu')->group(function () {
        //     Route::get('/',         'MenuEditController@index')->name('menu.menu.index');
        //     Route::get('/create',   'MenuEditController@create')->name('menu.menu.create');
        //     Route::post('/store',   'MenuEditController@store')->name('menu.menu.store');
        //     Route::get('/edit',     'MenuEditController@edit')->name('menu.menu.edit');
        //     Route::post('/update',  'MenuEditController@update')->name('menu.menu.update');
        //     Route::get('/delete',   'MenuEditController@delete')->name('menu.menu.delete');
        // });
        // Route::prefix('menu/element')->group(function () {
        //     Route::get('/',             'MenuElementController@index')->name('menu.index');
        //     Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
        //     Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
        //     Route::get('/create',       'MenuElementController@create')->name('menu.create');
        //     Route::post('/store',       'MenuElementController@store')->name('menu.store');
        //     Route::get('/get-parents',  'MenuElementController@getParents');
        //     Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
        //     Route::post('/update',      'MenuElementController@update')->name('menu.update');
        //     Route::get('/show',         'MenuElementController@show')->name('menu.show');
        //     Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
        // });
        // Route::prefix('media')->group(function ($router) {
        //     Route::get('/',                 'MediaController@index')->name('media.folder.index');
        //     Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
        //     Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
        //     Route::get('/folder',           'MediaController@folder')->name('media.folder');
        //     Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
        //     Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

        //     Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
        //     Route::get('/file',             'MediaController@file');
        //     Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
        //     Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
        //     Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
        //     Route::post('/file/cropp',      'MediaController@cropp');
        //     Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');

        //     Route::get('/file/download',    'MediaController@fileDownload');
        // });

        // Route::resource('roles',        'RolesController');
        // Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
        // Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');

        Route::get('/fasilitas/{id}', [FasilitasController::class, 'getFasilitas']);
        Route::post('/fasilitas', [FasilitasController::class, 'addFasilitas']);
        Route::delete('/fasilitas/{id}', [FasilitasController::class, 'deleteFasilitas']);
        Route::put('/fasilitas/{id}', [FasilitasController::class, 'setFasilitas']);

        Route::get('/tagihan/{id}', [TagihanController::class, 'getTagihan']);
        Route::post('/tagihan', [TagihanController::class, 'addTagihan']);

        Route::get('/kk/{id}', [KKController::class, 'getKK']);
        Route::post('/kk', [KKController::class, 'addKK']);
        Route::delete('/kk/{id}', [KKController::class, 'deleteKK']);
        Route::put('/kk/{id}', [KKController::class, 'setKK']);

        Route::get('/presensi', [PresensiController::class, 'getAllPresensi']);
        Route::post('/presensi', [PresensiController::class, 'cekPresensi']);

        Route::get('/perizinan', [PerizinanController::class, 'getAllPerizinan']);
        Route::post('/perizinan', [PerizinanController::class, 'addPerizinan']);

        Route::get('/pembayaran/{id}', [PembayaranController::class, 'getPembayaran']);
        Route::post('/pembayaran', [PembayaranController::class, 'addPembayaran']);
    });

    Route::group(['middleware' => 'manager'], function ($router) {
        Route::get('/pegawai/{id}', [PegawaiController::class, 'getPegawai']);
        Route::post('/pegawai', [PegawaiController::class, 'addPegawai']);
        Route::delete('/pegawai/{id}', [PegawaiController::class, 'deletePegawai']);
        Route::put('/pegawai/{id}', [PegawaiController::class, 'setPegawai']);

        Route::get('/jadwal', [JadwalController::class, 'getAllJadwal']);
        Route::post('/jadwal', [JadwalController::class, 'addJadwal']);
        Route::delete('/jadwal/{id}', [JadwalController::class, 'deleteJadwal']);
    });

    Route::group(['middleware' => 'user'], function($router) {
        Route::get('/pegawai', [PegawaiController::class, 'getAllPegawai']);
        Route::get('/kk', [KKController::class, 'getAllKK']);
        Route::get('/tagihan', [TagihanController::class, 'getAllTagihan']);
        Route::get('/fasilitas', [FasilitasController::class, 'getAllFasilitas']);
        Route::get('/pembayaran', [PembayaranController::class, 'getAllPembayaran']);
        Route::get('/laporanPresensi', [LaporanController::class, 'getLaporanPresensi']);
        Route::get('/laporanTagihan', [LaporanController::class, 'getLaporanTagihan']);
    });

    Route::get('/test/{idTagihan}', [PembayaranController::class, 'getBelumDibayar']);
    
});
