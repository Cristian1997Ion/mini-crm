<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get(
    '/',
    [App\Http\Controllers\ClientController::class, 'index']
)->name('home');

Route::put(
    '/clients/{id}/removeAvatar',
    [App\Http\Controllers\ClientController::class, 'removeAvatar']
)->name('removeAvatar');

Route::get(
    '/clients/search/{search?}',
    [App\Http\Controllers\ClientController::class, 'searchClients']
)->name('searchClients');


Route::resources([
    'clients'      => \App\Http\Controllers\ClientController::class,
    'transactions' => \App\Http\Controllers\TransactionController::class
]);
