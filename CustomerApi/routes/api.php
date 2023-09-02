<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('customers')->controller(\App\Http\Controllers\CustomerController::class)->group(function(){
    Route::get('/', 'list')->name('customers.list');
    Route::post('/', 'add')->name('customers.add');
    Route::get('/{id}', 'getById')->name('customers.get');
    Route::patch('/{id}', 'updateById')->name('customers.update');
    Route::delete('/{id}', 'deleteById')->name('customers.delete');
});
