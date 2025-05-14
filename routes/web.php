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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware'=> 'auth'],function(){

	Route::get('/home', 'HomeController@index')->name('home');


	Route::get('/home/delete-multiple', 'HomeController@deleteMultiple')->name('home.delete-multiple');
	Route::get('/home/change-multiple-status', 'HomeController@changeMultipleStatus')->name('home.change-multiple-status');


Route::group(['prefix' => 'user', 'as' => 'user.'],function(){

	Route::get('/index/','UserController@index')->name('index');
	Route::get('/create/','UserController@create')->name('create');
	Route::post('/store/','UserController@store')->name('store');
	Route::get('/edit/{id}','UserController@edit')->name('edit');
	Route::put('/update/{id}','UserController@update')->name('update');
    Route::post('/status','UserController@status')->name('status');
	Route::get('/show/{id}','UserController@show')->name('show');
	Route::put('/delete/{id}','UserController@update')->name('delete');
	
	Route::get('genratepdf/{id}','CustomerController@generatePdf')->name('genratepdf');
	

	Route::any('/user/email/{id}','UserController@email')->name('email');
	

	Route::get('/file-import', 'UserController@importView')->name('import-view');
	Route::post('/import', 'UserController@import')->name('import');
	Route::get('/export-users', 'UserController@exportUsers')->name('export-users');

	Route::get('genratepdf/{id}','OrderController@generatePdf')->name('genratepdf');
	
	
});

Route::group(['prefix' => 'product', 'as' => 'product.'],function(){

	Route::get('/index/','ProductController@index')->name('index');
	Route::get('/create/','ProductController@create')->name('create');
	Route::post('/store/','ProductController@store')->name('store');
	Route::get('/edit/{id}','ProductController@edit')->name('edit');
	Route::put('/update/{id}','ProductController@update')->name('update');
	Route::put('/delete/{id}','ProductController@delete')->name('delete');
	Route::get('/show/{id}','ProductController@show')->name('show');
	Route::get('genratepdf/{id}','OrderController@generatePdf')->name('genratepdf');
	
		
	});

	Route::group(['prefix' => 'order', 'as' => 'order.'],function(){

	Route::get('/index/','OrderController@index')->name('index');
	Route::get('/create/','OrderController@create')->name('create');
	Route::post('/store/','OrderController@store')->name('store');
	Route::get('/edit/{id}','OrderController@edit')->name('edit');
	Route::put('/update/{id}','OrderController@update')->name('update');
	Route::put('/delete/{id}','OrderController@delete')->name('delete');
	Route::get('/show/{id}','OrderController@show')->name('show');
		
	Route::get('genratepdf/{id}','OrderController@generatePdf')->name('genratepdf');
	
		
		});

	Route::group(['prefix' => 'customer', 'as' => 'customer.'],function(){

	Route::get('/index/','CustomerController@index')->name('index');
	Route::get('/create/','CustomerController@create')->name('create');
	Route::post('/store/','CustomerController@store')->name('store');
	Route::get('/edit/{id}','CustomerController@edit')->name('edit');
	Route::put('/update/{id}','CustomerController@update')->name('update');
	Route::put('/delete/{id}','CustomerController@delete')->name('delete');
	Route::get('/show/{id}','CustomerController@show')->name('show');
			
	Route::get('genratepdf/{id}','OrderController@generatePdf')->name('genratepdf');
	
			
		});

	Route::group(['prefix' => 'contact', 'as' => 'contact.'],function(){

	Route::get('/index/','ContactController@index')->name('index');
	Route::get('/create/','ContactController@create')->name('create');
	Route::post('/store/','ContactController@store')->name('store');
	Route::get('/edit/{id}','ContactController@edit')->name('edit');
	Route::put('/update/{id}','ContactController@update')->name('update');
	Route::put('/delete/{id}','ContactController@delete')->name('delete');
	// Route::get('/show/{id}','ContactController@show')->name('show');

	Route::get('genratepdf/{id}','OrderController@generatePdf')->name('genratepdf');
	
					
					
				});

	Route::group(['prefix' => 'contact', 'as' => 'contact.'],function(){

	Route::get('/index/','ContactController@index')->name('index');
	Route::get('/create/','ContactController@create')->name('create');
	Route::post('/store/','ContactController@store')->name('store');
	Route::get('/edit/{id}','ContactController@edit')->name('edit');
	Route::put('/update/{id}','ContactController@update')->name('update');
	Route::put('/delete/{id}','ContactController@delete')->name('delete');
	// Route::get('/show/{id}','ContactController@show')->name('show');

	Route::get('genratepdf/{id}','OrderController@generatePdf')->name('genratepdf');
	
					
					
				});
	
				Route::group(['prefix' => 'inventory', 'as' => 'inventory.'],function(){

					Route::get('/index/','InventoryController@index')->name('index');
					Route::get('/create/','InventoryController@create')->name('create');
					Route::post('/store/','InventoryController@store')->name('store');
					Route::get('/edit/{id}','InventoryController@edit')->name('edit');
					Route::put('/update/{id}','InventoryController@update')->name('update');
					Route::put('/delete/{id}','InventoryController@delete')->name('delete');
					Route::get('/show/{id}','InventoryController@show')->name('show');
				
					Route::get('genratepdf/{id}','InventoryController@generatePdf')->name('genratepdf');
					
									
									
								});
				Route::group(['prefix' => 'sells', 'as' => 'sells.'],function(){

					Route::get('/index/','SellsController@index')->name('index');
					Route::get('/create/','SellsController@create')->name('create');
					Route::post('/store/','SellsController@store')->name('store');
					Route::get('/edit/{id}','SellsController@edit')->name('edit');
					Route::put('/update/{id}','SellsController@update')->name('update');
					Route::put('/delete/{id}','SellsController@delete')->name('delete');
					Route::get('/show/{id}','SellsController@show')->name('show');
						
					
					Route::get('genratepdf/{id}','SellsController@generatePdf')->name('genratepdf');

				});
									
});
Route::get('/get-stock/{id}', 'SellsController@getStock');	
					
 Route::get('/order/delete/{id}', 'OrderController@deleteOrder')->name('deleteorder');
Route::get('/product/get-product-details/{id}', 'ProductController@getProductDetails')->name('product.getDetails');
Route::get('/order/get-order-details/{id}', 'OrderController@getorderDetails')->name('order.ordergetDetails');
