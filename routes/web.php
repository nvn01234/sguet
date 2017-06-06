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

Route::get('/', 'Web\HomeController@index')->name('home');

Route::get('about', 'Web\HomeController@about')->name('about');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('faq/index', 'Web\FaqController@index')->name('manage.faq');
Route::get('faq/create', 'Web\FaqController@create')->name('manage.faq.create');
Route::post('faq/create', 'Web\FaqController@store')->name('manage.faq.store');
Route::get('faq/search', 'Web\FaqController@search')->name('faq.search');
Route::get('faq/{id}', 'Web\FaqController@show')->name('faq.show');
Route::get('faq/{id}/edit', 'Web\FaqController@edit')->name('manage.faq.edit');
Route::post('faq/{id}/edit', 'Web\FaqController@update')->name('manage.faq.update');
Route::get('faq/{id}/delete', 'Web\FaqController@destroy')->name('manage.faq.delete');
Route::get('faq/{slug}', 'Web\FaqController@slug')->name('faq.slug');

Route::get('articles', 'Web\HomeController@articles')->name('articles');
Route::get('articles/index', 'Web\ArticleController@index')->name('manage.article');
Route::get('articles/create', 'Web\ArticleController@create')->name('manage.article.create');
Route::post('articles/create', 'Web\ArticleController@store')->name('manage.article.store');
Route::get('articles/{id}','Web\ArticleController@show')->name('articles.show');
Route::get('articles/{id}/edit', 'Web\ArticleController@edit')->name('manage.article.edit');
Route::post('articles/{id}/edit', 'Web\ArticleController@update')->name('manage.article.update');
Route::get('articles/{id}/delete', 'Web\ArticleController@destroy')->name('manage.article.delete');
Route::get('articles/{slug}', 'Web\ArticleController@slug')->name('articles.slug');

Route::get('search-log', 'Web\SearchLogController@index')->name('manage.search_log');
Route::get('search-log/{id}/delete', 'Web\SearchLogController@delete')->name('manage.search_log.delete');
Route::post('search-log/cleanup', 'Web\SearchLogController@cleanup')->name('manage.search_log.cleanup');

Route::get('users', 'Web\UserController@index')->name('manage.user');
Route::get('users/create', 'Web\UserController@create')->name('manage.user.create');
Route::post('users/create', 'Web\UserController@store')->name('manage.user.store');
Route::get('users/{id}/edit', 'Web\UserController@edit')->name('manage.user.edit');
Route::post('users/{id}/edit', 'Web\UserController@update')->name('manage.user.update');
Route::get('users/{id}/delete', 'Web\UserController@destroy')->name('manage.user.delete');

Route::get('account/change-password', 'Auth\ChangePasswordController@show')->name('auth.password.change.show');
Route::post('account/change-password', 'Auth\ChangePasswordController@change')->name('auth.password.change');

Route::get('contacts', 'Web\ContactController@index')->name('contact.index');
Route::get('contacts/index', 'Web\ContactController@manage')->name('manage.contact');
Route::post('contacts/upload', 'Web\ContactController@upload')->name('manage.contact.upload');

Route::get('backup', 'Web\BackupController@index')->name('manage.backup');
Route::post('backup/run', 'Web\BackupController@backup')->name('manage.backup.run');
Route::get('backup/download/{file_name}', 'Web\BackupController@download')->name('manage.backup.download');
Route::post('backup/delete', 'Web\BackupController@delete')->name('manage.backup.delete');

Route::get('googleeadd1946a0bd73da.html', 'Web\HomeController@google_site_verification');
Route::get('hong', 'Web\HomeController@hong');
Route::get('hongdiemthi', 'Web\HomeController@hong');

Route::get('links', 'Web\HomeController@links')->name('links');

Route::get('feedback', 'Web\FeedbackController@index')->name('manage.feedback');
Route::get('feedback/create', 'Web\FeedbackController@create')->name('feedback.create');
Route::post('feedback/create', 'Web\FeedbackController@store')->name('feedback.store');
Route::get('feedback/{id}/process', 'Web\FeedbackController@process')->name('manage.feedback.process');
Route::get('feedback/{id}/delete', 'Web\FeedbackController@delete')->name('manage.feedback.delete');
Route::get('feedback/{id}/detail', 'Web\FeedbackController@detail')->name('manage.feedback.detail');
