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

Route::get('/', function () {
    return view('welcome');
});
  
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['web']],function(){
Route::resource('/contactPhone','ContactPhone');
Route::resource('contacts', 'ContactController');
Route::get('/contacnts/search','ContactController@search');

});
Auth::routes();

