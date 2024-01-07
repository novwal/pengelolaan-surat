<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\ResultsController;

Route::get('/error-permission', fn() => view('errors.permission'))->name('error.permission');

Route::middleware(['IsGuest'])->group(function() {
    Route::get('/', fn() => view('login'))->name('login');
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
});

Route::middleware(['IsLogin'])->group(function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/home', [UserController::class, 'index'])->name('home.page');

    Route::middleware(['IsStaff'])->group(function() {
        Route::prefix('/userStaff')->name('userStaff.')->group(function() {
            Route::get('/create', [UserController::class, 'Staffcreate'])->name('create');
            Route::post('/store', [UserController::class, 'Staffstore'])->name('store');
            Route::get('/', [UserController::class, 'Staffindex'])->name('home');
            Route::get('/{id}', [UserController::class, 'Staffedit'])->name('edit');
            Route::patch('/{id}', [UserController::class, 'Staffupdate'])->name('update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
        });

        Route::prefix('/export')->name('export.')->group(function () {
            Route::get('/data', [LetterTypeController::class, 'data'])->name('data');
            Route::get('/export-excel', [LetterTypeController::class, 'fileExport'])->name('export-excel');
            Route::get('/download/{id}', [LetterTypeController::class, 'downloadPDF'])->name('download');
        });

        Route::prefix('/export-excel')->name('export-excel.')->group(function() {
            Route::get('/export-excel', [LetterController::class, 'fileExport'])->name('export');
        });

        Route::prefix('/KlasifikasiSurat')->name('KlasifikasiSurat.')->group(function() {
            Route::get('/create', [LetterTypeController::class, 'create'])->name('create');
            Route::post('/store', [LetterTypeController::class, 'store'])->name('store');
            Route::get('/', [LetterTypeController::class, 'index'])->name('home');
            Route::get('/{id}', [LetterTypeController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [LetterTypeController::class, 'update'])->name('update');
            Route::delete('/{id}', [LetterTypeController::class, 'destroy'])->name('delete');
        });

        Route::prefix('/dataSurat')->name('dataSurat.')->group(function() {
            Route::get('/create', [LetterController::class, 'create'])->name('create');
            Route::post('/store', [LetterController::class, 'store'])->name('store');
            Route::get('/', [LetterController::class, 'index'])->name('home');
            Route::get('/{id}', [LetterController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [LetterController::class, 'update'])->name('update');
            Route::get('/print/{id}', [LetterController::class, 'show'])->name('print');
            Route::get('/download/{id}', [LetterController::class, 'downloadPDF'])->name('download');
            Route::delete('/{id}', [LetterTypeController::class, 'destroy'])->name('delete');
        });
    });

    Route::middleware(['IsGuru'])->group(function() {
        Route::prefix('/result')->name('result.')->group(function() {
            Route::get('/results/{id}', [ResultsController::class, 'create'])->name('results');
            Route::post('/store', [ResultsController::class, 'store'])->name('store');
            Route::get('/show/{id}', [ResultsController::class, 'show'])->name('show');
        });

        Route::prefix('/dataSurat')->name('dataSurat.')->group(function() {
            Route::get('/', [LetterController::class, 'index'])->name('home');
        });
    });
});
