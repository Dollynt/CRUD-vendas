<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
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
    return view('welcome');
});

Route::get('/criar_cliente', [ClienteController::class, 'create'])->name('cliente.create');
Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente.index');
Route::post('/criar_cliente', [ClienteController::class, 'store'])->name('cliente.store');



Route::get('/criar_produto', [ProdutoController::class, 'create'])->name('produto.create');
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produto.index');
Route::post('/criar_produto', [ProdutoController::class, 'store'])->name('produto.store');
