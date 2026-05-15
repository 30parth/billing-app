<?php

use App\Http\Controllers\BillPdfController;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'dashboard.dashboard')->name('dashboard');

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
