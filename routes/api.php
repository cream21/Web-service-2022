<?php

use App\Http\Controllers\GajiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/pegawai',[PegawaiController::class,'index']);
Route::post('/pegawai',[PegawaiController::class,'store']);
Route::put('/pegawai/{id?}',[PegawaiController::class,'update']);
Route::delete('/pegawai/{id?}',[PegawaiController::class,'destroy']);
Route::get('/pegawai/relasi',[PegawaiController::class,'cek_relasei']);

//
Route::group(['middleware' => 'auth:api'], function ($router) { 

Route::get('/golongan',[GolonganController::class,'index']);
Route::post('/golongan',[GolonganController::class,'store']);
Route::put('/golongan/{id?}',[GolonganController::class,'update']);
Route::delete('/golongan/{id?}',[GolonganController::class,'destroy']);
Route::get('/golongan/relasi/golongan',[GolonganController::class,'cek_relasi_pegawai']);
Route::get('/golongan/relasi/gaji',[GolonganController::class,'cek_relasi_gaji']);

//
Route::get('/gaji',[GajiController::class,'index']);
Route::post('/gaji',[GajiController::class,'store']);
Route::put('/gaji/{id?}',[GajiController::class,'update']);
Route::delete('/gaji/{id?}',[GajiController::class,'destroy']);
});
    //
    Route::group(['middleware' => 'api'], function ($router) {

        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);

    Route::get('password', function () {
        return bcrypt('wisnu123');
    });
});
