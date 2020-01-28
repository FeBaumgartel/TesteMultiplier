<?php

use Illuminate\Http\Request;
use Symfony\Component\Mime\Header\Headers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

header('Access-Control-Allow-Origin:*');
Route::get('produto','ProdutoController@getProdutos');
Route::get('produto/deleted','ProdutoController@getDeletedProdutos');
Route::post('produto','ProdutoController@postProdutos');
Route::put('produto','ProdutoController@putProdutos');
Route::delete('produto','ProdutoController@deleteProdutos');
