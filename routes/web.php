<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\santriController;
use App\Http\Controllers\pembimbingController;
use App\Http\Controllers\walsanController;
use App\Http\Controllers\jurnalController;

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/register', function () {
    return view('auth/login');
});
Route::get('/fnh', [userController::class, 'fnh'])->name('fnh');

Route::middleware(['auth:sanctum', 'verified'])->prefix('pkl')->group(function () {
    Route::get('dashboard', [userController::class, 'dashboard'])->name('dashboard');
    Route::get('xyz', [userController::class, 'getBulan'])->name('xyz');

    Route::middleware(['admin'])->prefix('santri')->group(function () {
        Route::get('/', [santriController::class, 'index'])->name('santri');
        Route::get('/add', [santriController::class, 'create'])->name('addSantri');
        Route::post('/save', [santriController::class, 'store'])->name('saveSantri');
        Route::get('/edit/{santri:nisn}', [santriController::class, 'edit'])->name('editSantri');
        Route::put('/update/{santri:nisn}', [santriController::class, 'update'])->name('updateSantri');
        Route::delete('/delete/{santri:nisn}', [santriController::class, 'destroy'])->name('deleteSantri');
        Route::post('/upload', [santriController::class, 'uploadExcel'])->name('uploadSantri');
        Route::get('/contoh', [santriController::class, 'contohFile'])->name('contohFile');
    });

    Route::middleware(['admin'])->prefix('pembimbing')->group(function () {
        Route::get('/', [pembimbingController::class, 'index'])->name('pembimbing');
        Route::get('/add', [pembimbingController::class, 'create'])->name('addPembimbing');
        Route::post('/save', [pembimbingController::class, 'store'])->name('savePembimbing');
        Route::get('/edit/{pembimbing:id}', [pembimbingController::class, 'edit'])->name('editPembimbing');
        Route::put('/update/{pembimbing:id}', [pembimbingController::class, 'update'])->name('updatePembimbing');
        Route::delete('/delete/{pembimbing:id}', [pembimbingController::class, 'destroy'])->name('deletePembimbing');
    });

    Route::middleware(['admin'])->prefix('walisantri')->group(function () {
        Route::get('/', [walsanController::class, 'index'])->name('walsan');
        Route::get('/add', [walsanController::class, 'create'])->name('addWalsan');
        Route::post('/save', [walsanController::class, 'store'])->name('saveWalsan');
        Route::get('/edit/{walsan:id}', [walsanController::class, 'edit'])->name('editWalsan');
        Route::put('/update/{walsan:id}', [walsanController::class, 'update'])->name('updateWalsan');
        Route::delete('/delete/{walsan:id}', [walsanController::class, 'destroy'])->name('deleteWalsan');
    });

    Route::prefix('jurnal')->group(function () {
        Route::get('/', [jurnalController::class, 'index'])->name('jurnal');
        Route::get('/santri/{nisn}', [jurnalController::class, 'santri'])->name('jurnalSantri');
        Route::get('/detail/{jurnal:id}', [jurnalController::class, 'detail'])->name('jurnalDetail');
        Route::get('/add', [jurnalController::class, 'create'])->name('addJurnal');
        Route::post('/save', [jurnalController::class, 'store'])->name('saveJurnal');
        Route::get('/edit/{id}', [jurnalController::class, 'edit'])->name('jurnalEdit');
        Route::put('/update/{id}', [jurnalController::class, 'update'])->name('updateJurnal');
        Route::delete('/delete/{id}', [jurnalController::class, 'destroy'])->name('deleteJurnal');
    });
});