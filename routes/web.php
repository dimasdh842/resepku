<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResepController;
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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\ResepController::class, 'showallcard'])->name('home');
Route::get('/suka/{id}', [App\Http\Controllers\ResepController::class, 'suka'])->name('suka.update');
// Route::get('/resep/{id}', [App\Http\Controllers\ResepController::class, 'delete'])->name('resep.delete');

// Route::controller(ResepController::class)->group(function () {
//     Route::get('/resep','index');
//     Route::get('/resep/{id}','detail');
//     Route::get('/tambah-resep','create')->name("tambah-resep");
//     Route::post('/resep','createProcess');
//     Route::get('/edit-resep','update')->name("edit-resep");
//     Route::put('/resep','updateProcess');
//     Route::delete('/resep','delete');
// });

Route::resource('/resep', ResepController::class);