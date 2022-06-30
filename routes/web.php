<?php

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
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;


Route::get('/',[EventController::class, 'index']);
Route::get('/events/create',[EventController::class, 'create'])->middleware('auth');
Route::get('/events/{id}',[EventController::class, 'show']);
Route::post('/events',[EventController::class, 'store']);
Route::delete('/events/{id}',[EventController::class, 'destroy'])->middleware('auth');; //Rota para deletar eventos
Route::get('/events/edit/{id}',[EventController::class, 'edit'])->middleware('auth');; //Rota para editar eventos
Route::put('/events/update/{id}',[EventController::class, 'update'])->middleware('auth');; //Rota para  salvar dados editados eventos


Route::get('/contact',[ProductController::class, 'contact']);
Route::get('/produtos',[ProductController::class, 'product']);
Route::get('/produtos_teste/{id?}',[ProductController::class, 'product_test']);


Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth'); //Rota de acesso a dashboard de eventos.
Route::post('/events/join/{id}',[EventController::class, 'joinEvent'])->middleware('auth'); //Rota para ligação de usuario a evento.
Route::delete('/events/leave/{id}',[EventController::class, 'leaveEvent'])->middleware('auth'); //Rota para ligação de usuario a evento.



