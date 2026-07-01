<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillPdfController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return redirect()->route('login');
    })->name('home');

    Route::livewire('login', 'auth.login')->name('login');
    Route::livewire('register', 'auth.register')->name('register');

    Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
    Route::get('auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

});

Route::get('/invoice/{id}', [BillPdfController::class, 'publicPreview'])->name('bill.public.preview')->middleware('signed');
Route::get('/invoice/{id}/download', [BillPdfController::class, 'publicDownload'])->name('bill.public.download')->middleware('signed');

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::livewire('/dashboard', 'dashboard.dashboard')->name('dashboard');
    Route::livewire('/settings', 'setting.setting-form')->name('setting');

    Route::prefix('product')->name('product.')->group(function () {
        Route::livewire('/', 'product.product-list')->name('list');
        Route::livewire('add', 'product.product-form')->name('add');
        Route::livewire('edit/{id}', 'product.product-form')->name('edit');
    });

    Route::prefix('bill')->name('bill.')->group(function () {
        Route::livewire('/', 'bill.bil-list')->name('list');
        Route::livewire('add', 'bill.bill-form')->name('add');
        Route::livewire('edit/{id}', 'bill.bill-form')->name('edit');
        Route::get('{id}/pdf', [BillPdfController::class, 'generate'])->name('pdf');
    });

    Route::get('/clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');

        return 'cache cleared successfully';
    });

});
