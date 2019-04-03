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

Auth::routes();

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/support', function () {
    return view('static_pages.support');
})->name('support');

Route::get('/about', function () {
    return view('static_pages.about');
})->name('about');

Route::get('/search', 'SearchController@index')->name('search');
Route::post('/search', 'SearchController@search');

Route::resource('ingredients', 'IngredientController');
Route::resource('recipes', 'RecipeController');
Route::get('/home', 'HomeController@index')->name('home');
Route::put('/home/changepw', 'HomeController@changepw');
Route::get('/home/address', 'HomeController@showAddress');
Route::post('/home/address', 'HomeController@addAddress');
Route::delete('/home/address', 'HomeController@deleteAddress');
Route::put('/home/address', 'HomeController@primaryAddress');
Route::get('/home/orders', 'HomeController@showOrders');
Route::delete('/home/orders', 'HomeController@cancelOrder');

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/recipes', 'AdminController@recipe');
Route::get('/admin/orders', 'AdminController@orders');
Route::put('/admin/orders', 'AdminController@changeOrder');

Route::get('/cart', 'OrderController@cart');
Route::post('/cart', 'OrderController@add');
Route::put('/cart/address', 'OrderController@changeAddress');
Route::put('/cart/quantity', 'OrderController@changeQuantity');
Route::post('/payment', 'PaymentController@payment');