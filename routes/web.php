<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth', 'isBanned']], function () {
    Route::get('/', \App\Http\Livewire\Device\Index::class)->name('main');
    Route::get('/logout', \App\Http\Livewire\Auth\Logout::class)->name('logout')->withoutMiddleware('isBanned');

    Route::group(['middleware' => 'hasRole:admin', 'prefix' => 'admin'], function () {
        Route::get('users', \App\Http\Livewire\Admin\User\Index::class)->name('admin.users.index');
        Route::get('devices', \App\Http\Livewire\Admin\Device\Index::class)->name('admin.devices.index');
    });
});
Route::get('/login', \App\Http\Livewire\Auth\Login::class)->name('login');
