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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@home');
Route::get('/tin-tuc-hoat-dong', 'HomeController@articles')->name('articles');
Route::get('/gioi-thieu', 'HomeController@about')->name('about');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
//Auth::routes();

Route::get('/quan-ly/faq', 'FaqController@index')->name('manage.faq');
Route::get('/quan-ly/faq/tao-moi', 'FaqController@create')->name('manage.faq.create');
Route::post('/quan-ly/faq/tao-moi', 'FaqController@store')->name('manage.faq.store');
Route::get('/quan-ly/faq/{id}/sua', 'FaqController@edit')->name('manage.faq.edit');
Route::post('/quan-ly/faq/{id}/sua', 'FaqController@update')->name('manage.faq.update');
Route::get('/quan-ly/faq/{id}/xoa', 'FaqController@destroy')->name('manage.faq.delete');