<?php

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

Route::resource('pedido','PedidoController');
Route::resource('produto','ProdutoController');

Route::get('pedido/finalizarPedido/{pedido}', 'PedidoController@finalizarPedido')->name('pedido.finalizarPedido');
Route::post('pedido/addProduct', 'PedidoController@addProduct')->name('pedido.addProduct');
Route::get('pedido/addProductIndex/{pedido}', 'PedidoController@addProductIndex')->name('pedido.addProductIndex');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
