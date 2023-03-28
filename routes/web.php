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
Route::get('/criar_cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/criar_produto', [ProdutoController::class, 'index'])->name('produto.index');
