<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GanttController;
use App\Http\Controllers\ConfigController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [GanttController::class,'index'])->name('index');

Route::get('/config', [ConfigController::class,'create'])->name('config.create');
Route::post('/config', [ConfigController::class,'store'])->name('config.store');
Route::delete('/config', [ConfigController::class,'delete'])->name('config.delete');