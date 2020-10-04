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
// Route::any('/password/reset', function(){
//     return abort(404);
//  });
Route::get('/', 'HomeController@index')->name('home');
Auth::routes();
Route::post('/search','SearchController@show');
Route::get('/search','SearchController@search');
Route::any('/topup/{user}','WalletController@update');
Route::patch('/profile/update/{user}', 'ProfileController@update');
Route::any('/profile/{user}', 'ProfileController@show');
Route::any('/profile/{user}/edit', 'ProfileController@edit');
Route::get('/item/{item}', 'ItemController@show');
Route::any('/sell', 'ItemController@create');
Route::post('/listitem', 'ItemController@list');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/bid/{item}', 'BidController@bid');
Route::any('/walletupdate/{user}','WalletController@topup');
?>