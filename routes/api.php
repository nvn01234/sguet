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
Route::post('/faq/delete', 'Api\FaqApiController@destroy')->name('api.faq.delete')->middleware('auth');
Route::post('/faq/sync', 'Api\FaqApiController@syncToSearch')->name('api.faq.sync');

Route::get('/article', 'Api\ArticleApiController@index')->name('api.article.index');
