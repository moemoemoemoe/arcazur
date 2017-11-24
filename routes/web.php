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
Route::get('api/get_offers', 'ApiController@get_offers')->name('get_offers');
Route::get('api/spec_offer/{id}', 'ApiController@spec_offer')->name('spec_offer');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/add_offers', 'OfferController@add_offers')->name('add_offers')->middleware('auth');
Route::post('admin/add_offers', 'OfferController@add_offers_save')->name('add_offers')->middleware('auth');

Route::get('admin/manage_offers', 'OfferController@manage_offers')->name('manage_offers')->middleware('auth');

Route::get('admin/view_offer/{id}', 'OfferController@view_offer')->name('view_offer')->middleware('auth');
Route::post('admin/view_offer/{id}', 'OfferController@view_offer_save')->name('view_offer')->middleware('auth');

Route::get('admin/publish_offer/{id}', 'OfferController@publish_offer')->name('publish_offer')->middleware('auth');
Route::get('admin/main_article/{name}', 'OfferController@main_article')->name('main_article');

Route::get('admin/delete_image/{id}', 'OfferController@delete_image')->name('delete_image');