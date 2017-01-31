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
Route::post('/faq/algolia', 'Api\FaqApiController@algolia')->name('api.faq.algolia');
Route::get('/faq/datatable', 'Api\FaqApiController@datatable')->name('api.faq.datatable');

Route::get('/article', 'Api\ArticleApiController@index')->name('api.article.index');
Route::get('/article/{id}', 'Api\ArticleApiController@show')->name('api.article.show');
