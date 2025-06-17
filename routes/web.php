<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankAccountController;




Route::get('/', fn() => redirect('/accounts'));

// Route::resource('accounts', BankAccountController::class)->except(['edit', 'update', 'destroy']);

// Route::post('/accounts/{account}/deposit', [BankAccountController::class, 'deposit'])->name('accounts.deposit');
// Route::post('/accounts/{account}/withdraw', [BankAccountController::class, 'withdraw'])->name('accounts.withdraw');


Route::prefix('/accounts')
    ->controller(App\Http\Controllers\BankAccountController::class)
    ->name('accounts.')
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}','show')->name('show');
        Route::post('/store', 'store')->name('store');
        Route::get('info/{id}', 'info')->name('info');

        Route::post('/{id}/deposit', 'deposit')->name('deposit');
        Route::post('/{id}/withdraw', 'withdraw')->name('withdraw');

    });