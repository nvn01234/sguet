<?php

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

Route::get('/faq/search', 'Api\FaqApiController@search')->name('api.faq.search');
Route::post('/faq/delete', 'Api\FaqApiController@destroy')->name('api.faq.delete');

Route::get('/article', 'Api\ArticleApiController@index')->name('api.article.index');
Route::get('/article/{id}', 'Api\ArticleApiController@show')->name('api.article.show');
