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

Route::get('contacts/roots', 'Api\ContactApiController@roots')->name('api.contacts.roots');
Route::get('contacts/children', 'Api\ContactApiController@children')->name('api.contacts.children');
Route::get('contacts/data', 'Api\ContactApiController@data')->name('api.contacts.data');
Route::get('contacts/search', 'Api\ContactApiController@search')->name('api.contacts.search');

Route::get('contacts/{id}', 'Api\SubjectApiController@show');
Route::get('faqs/search', 'Api\FaqApiController@search');
Route::get('faqs/{id}', 'Api\FaqApiController@show');
Route::get('subjects/search', 'Api\SubjectApiController@search');
Route::get('subjects/{id}', 'Api\SubjectApiController@show');
Route::get('documents/search', 'Api\DocumentApiController@search');
Route::get('documents/{id}', 'Api\DocumentApiController@show');