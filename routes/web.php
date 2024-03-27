<?php

use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);
Route::get('/siswa-view',[App\Http\Controllers\Auth\LoginController::class, 'loginsiswa'])->name('siswa.view');
Route::post('/siswa-login',[App\Http\Controllers\Auth\LoginController::class, 'siswaLogin'])->name('siswa.login');

Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('kelas',KelasController::class);
    Route::resource('spp',SppController::class);
    Route::resource('siswa',SiswaController::class);
    Route::resource('pembayaran',PembayaranController::class);
    Route::resource('petugas',PetugasController::class);
});


Route::get('/dashboard',[App\Http\Controllers\HomeController::class,'siswa'])->name('dashboard')
->middleware('auth:siswa');