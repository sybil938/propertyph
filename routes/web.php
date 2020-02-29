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

Route::group(['prefix' => 'properties'], function(){	
	//VIEW ITEM
	Route::get('/apartment/{id}/view', 'ApartmentController@apartmentView');
	Route::get('/condominium/{id}/view', 'CondominiumController@condoView');
	Route::get('/dormitory/{id}/view', 'DormitoryController@dormView');
	Route::get('/house/{id}/view', 'HouseController@houseView');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

	Route::group(['prefix' => 'profile'], function(){
		Route::get('/', 'ProfileController@index');
		Route::post('/', 'ProfileController@update');
	});	

	Route::group(['prefix' => 'properties'], function(){	
		Route::get('/', 'PropertyController@index');
		//DATATABLE
		Route::get('/', 'PropertyController@allProp');
		Route::get('/apartment', 'PropertyController@apartment');
		Route::get('/condominium', 'PropertyController@condominium');
		Route::get('/dormitory', 'PropertyController@dormitory');
		Route::get('/house', 'PropertyController@house');
		//ADD PROPERTY
		Route::get('/create', 'PropertyController@create');
		Route::post('/create', 'PropertyController@add');
		//DELETE PROPERTY	
		Route::get('/apartment/{id}', 'ApartmentController@remove');
		Route::get('/condominium/{id}', 'CondominiumController@remove');
		Route::get('/dormitory/{id}', 'DormitoryController@remove');
		Route::get('/house/{id}', 'HouseController@remove');					
		//VIEW|EDIT PROPERTY
		Route::get('/apartment/{id}/edit', 'ApartmentController@apartmentEditView');
		Route::post('/apartment/{id}/edit', 'ApartmentController@apartmentEdit');		
		Route::get('/condominium/{id}/edit', 'CondominiumController@condoEditView');
		Route::post('/condominium/{id}/edit', 'CondominiumController@condoEdit');	
		Route::get('/dormitory/{id}/edit', 'DormitoryController@dormEditView');
		Route::post('/dormitory/{id}/edit', 'DormitoryController@dormEdit');	
		Route::get('/house/{id}/edit', 'HouseController@houseEditView');
		Route::post('/house/{id}/edit', 'HouseController@houseEdit');	
	});

});