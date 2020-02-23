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
    return redirect()->route('store.index');
});


// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

Route::group(['prefix' => 'admin'], function(){

  	Route::get('/panel', 'AdminsController@index')->name('admin.index');

  	Route::group(['prefix' => 'categorias'], function(){
		Route::get('/', 'CategoryController@index')->name('categories.index');
		Route::post('store', 'CategoryController@store')->name('categories.store');
		Route::delete('destroy/{category}', 'CategoryController@destroy')->name('categories.destroy');

	});

	Route::group(['prefix' => 'proveedores'], function(){
		Route::get('/', 'SupplierController@index')->name('suppliers.index');
	});

	Route::group(['prefix' => 'productos'], function(){
		Route::get('/', 'ProductController@index')->name('products.index');
	});
 
});

Route::group(['prefix' => 'tienda'], function(){

  	Route::get('/', 'StoreController@index')->name('store.index');   
  	Route::get('/productos', 'StoreController@products')->name('products.index');   

  	Route::post('/agregarCarrito/{prod}', 'OrderController@addCart')->name('addCart');   
  	Route::get('/carrito', 'CartController@index')->name('cart');   
  	
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
