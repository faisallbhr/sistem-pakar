<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\DepresiController;
use App\Http\Controllers\KondisiController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeputusanController;
use App\Http\Controllers\AdminSettingController;

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
    return view('pages.welcome');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // GEJALA ROUTE
    Route::get('/gejala', [GejalaController::class, 'index'])->name('gejala.index');
    Route::get('/gejala/search', [GejalaController::class, 'search'])->name('gejala.search');
    Route::post('/gejala', [GejalaController::class, 'store'])->name('gejala.store');
    Route::put('/gejala/{kode}', [GejalaController::class, 'update'])->name('gejala.update');
    Route::delete('/gejala/{kode}', [GejalaController::class, 'destroy'])->name('gejala.destroy');

    // KONDISI ROUTE
    Route::get('/kondisi', [KondisiController::class, 'index'])->name('kondisi.index');
    Route::get('/kondisi/search', [KondisiController::class, 'search'])->name('kondisi.search');
    Route::post('/kondisi', [KondisiController::class, 'store'])->name('kondisi.store');
    Route::put('/kondisi/{id}', [KondisiController::class, 'update'])->name('kondisi.update');
    Route::delete('/kondisi/{id}', [KondisiController::class, 'destroy'])->name('kondisi.destroy');

    // DEPRESI ROUTE
    Route::get('/depresi', [DepresiController::class, 'index'])->name('depresi.index');
    Route::get('/depresi/search', [DepresiController::class, 'search'])->name('depresi.search');
    Route::post('/depresi', [DepresiController::class, 'store'])->name('depresi.store');
    Route::put('/depresi/{kode}', [DepresiController::class, 'update'])->name('depresi.update');
    Route::delete('/depresi/{kode}', [DepresiController::class, 'destroy'])->name('depresi.destroy');

    // KEPUTUSAN ROUTE
    Route::get('/keputusan', [KeputusanController::class, 'index'])->name('keputusan.index');
    Route::get('/keputusan/search', [KeputusanController::class, 'search'])->name('keputusan.search');
    Route::post('/keputusan', [KeputusanController::class, 'store'])->name('keputusan.store');
    Route::put('/keputusan/{kode_rule}', [KeputusanController::class, 'update'])->name('keputusan.update');
    Route::delete('/keputusan/{kode_rule}', [KeputusanController::class, 'destroy'])->name('keputusan.destroy');

    // DIAGNOSA ROUTE
    Route::get('/diagnosa/test', [DiagnosaController::class, 'test'])->name('diagnosa.test');
    Route::post('/diagnosa/test', [DiagnosaController::class, 'store'])->name('diagnosa.store');
    Route::get('/diagnosa/history', [DiagnosaController::class, 'index'])->name('diagnosa.history.index');
    Route::get('/diagnosa/result/{diagnosaId}', [DiagnosaController::class, 'result'])->name('diagnosa.result.user');
    Route::get('/diagnosa/history/{userId?}', [DiagnosaController::class, 'history'])->name('diagnosa.history.user');
    Route::get('/diagnosa/search', [DiagnosaController::class, 'search'])->name('diagnosa.result.search');
    Route::get('/diagnosa/download/{id}', [DiagnosaController::class, 'download'])->name('diagnosa.download');

    // ADMIN SETTING
    Route::get('/admin', [AdminSettingController::class, 'index'])->name('admin.index');
    Route::get('/admin/register', [AdminSettingController::class, 'register'])->name('admin.register');
    Route::post('/admin/register', [AdminSettingController::class, 'create'])->name('admin.create');

    Route::fallback(function () {
        return view('pages/utility/404');
    });
});
