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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

	Route::group(['prefix' => 'profile'], function(){
		Route::get('/', 'ProfileController@index');
		Route::post('/', 'ProfileController@update');
	});	

	Route::group(['prefix' => 'properties'], function(){	
		Route::get('/', 'PropertyController@index');
		//DATATABLE
		Route::get('/', 'PropertyController@apartment');
		Route::get('/condominium', 'PropertyController@condominium');
		Route::get('/dormitory', 'PropertyController@dormitory');
		Route::get('/house', 'PropertyController@house');
		//VIEW ITEM
		Route::get('/apartment/{id}/view', 'PropertyController@apartmentView');
		Route::get('/condominium/{id}/view', 'PropertyController@condoView');
		Route::get('/dormitory/{id}/view', 'PropertyController@dormView');
		Route::get('/house/{id}/view', 'PropertyController@houseView');
		//VIEW EDIT ITEM
		Route::get('/apartment/{id}/edit', 'PropertyController@apartmentEditView');
		Route::post('/apartment/{id}/edit', 'PropertyController@apartmentEdit');		
		Route::get('/condominium/{id}/edit', 'PropertyController@condoEditView');
		Route::post('/condominium/{id}/edit', 'PropertyController@condoEdit');	
		Route::get('/dormitory/{id}/edit', 'PropertyController@dormEditView');
		Route::post('/dormitory/{id}/edit', 'PropertyController@dormEdit');	
		Route::get('/house/{id}/edit', 'PropertyController@houseEditView');
		Route::post('/house/{id}/edit', 'PropertyController@houseEdit');					
		//ADD PROPERTY
		Route::get('/create', 'PropertyController@create');
		Route::post('/create', 'PropertyController@addProperty');
	});

});