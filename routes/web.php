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

Route::get('/', function () {
    //se quita la pagina de welcome y te lleva directo al login
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

                                    //controlador que usa        funcion que busca   nombre de vista
//Route::get('/test', [App\Http\Controllers\TasksController::class, 'index'])->name('test');


//ruta para usar el controlador de recursos
Route::resource('task','App\Http\Controllers\TasksController' );
