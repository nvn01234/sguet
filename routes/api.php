<?php

use Illuminate\Http\Request;

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

Route::get('/tim-kiem/faq', 'Api\ArticleApiController@searchFaq');
Route::get('/tin-tuc-hoat-dong', 'Api\ArticleApiController@indexNewsActivitiesHtml')->name('api.news.index');
Route::get('/bai-dang/{id}', 'Api\ArticleApiController@showHtml')->name('api.article.show');
Route::get('/index-faq', 'Api\ArticleApiController@indexFaq');