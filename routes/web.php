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

Route::get('/', [
    'as' => 'home',
    'uses' => 'Web\MainController@home'
]);

Route::get('/email', 'Web\EmailController@sendEmail');

Route::prefix('parse')->group(function () {

    Route::get('/', [
        'as' => 'parse',
        'uses' => 'Web\ParseController@index'
    ]);

    Route::group(['prefix' => '/'], function () {

        Route::get('category', [
            'as' => 'category',
            'uses' => 'Web\ParseController@parseCategory'
        ]);

        Route::post('category', 'Web\ParseController@parseCategory')->name('index.parse.category');


        Route::post('category/download', ['as' => 'category.download', 'uses' => 'Web\ParseController@getCategoryCSV']);
        Route::post('category/add', ['as' => 'category/add', 'uses' => 'Web\ParseController@getCategoryCSV']);


        Route::get('manufacturer', [
            'as' => 'manufacturer',
            'uses' => 'Web\ParseController@parseManufacturer'
        ]);
        Route::post('manufacturer', 'Web\ParseController@parseManufacturer')->name('index.parse.manufacturer');


        Route::post('manufacturer/download', ['as' => 'manufacturer.download', 'uses' => 'Web\ParseController@getManufacturerCSV']);
        Route::post('manufacturer/add', ['as' => 'manufacturer/add', 'uses' => 'Web\ParseController@getManufacturerCSV']);


        Route::get('product', [
            'as' => 'product',
            'uses' => 'Web\ParseController@parseProduct'
        ]);

        Route::post('product', 'Web\ParseController@parseProduct')->name('index.parse.product');


        Route::post('product/download', ['as' => 'product.download', 'uses' => 'Web\ParseController@getProductCSV']);
        Route::post('product/add', ['as' => 'product/add', 'uses' => 'Web\ParseController@getProductCSV']);


        Route::get('node', 'Web\ParseController@parseNode')->name('index.parse.node');
        Route::post('node', 'Web\ParseController@parseNode')->name('index.parse.node');

        Route::get('subcategory', [
            'as' => 'subcategory',
            'uses' => 'Web\ParseController@parseSubcategory'
        ]);

        Route::post('subcategory', 'Web\ParseController@parseSubcategory')->name('index.parse.subcategory');

        Route::post('subcategory/download', ['as' => 'subcategory.download', 'uses' => 'Web\ParseController@getSubcategoryCSV']);
        Route::post('subcategory/add', ['as' => 'subcategory/add', 'uses' => 'Web\ParseController@getSubcategoryCSV']);

    });
});


Route::group(['prefix' => 'configurations'], function () {
        Route::get('/search', 'Web\ConfigurationController@search');
        Route::post('search', 'Web\ConfigurationController@search')->name('live_search.action');
        Route::delete('myproductsDeleteAll', 'Web\ConfigurationController@deleteAll')->name('delete.all');
        Route::get('/', [
            'as' => 'configurations',
            'uses' => 'Web\ConfigurationController@index'
        ]);
        Route::get('/all', [
            'as' => 'all',
            'uses' => 'Web\ConfigurationController@getAllConfigurations'  
        ])->middleware('admin');

	    Route::match(['get', 'post'], 'create', 'Web\ConfigurationController@create');
	    Route::match(['get', 'put'], 'update/{id}', 'Web\ConfigurationController@update');
	    Route::delete('delete/{id}', 'Web\ConfigurationController@delete')->name('conf.delete');
	});


Route::group(['prefix' => 'logs'], function () {
    Route::get('/search', 'Web\LogController@search')->name('live_search.action');
    Route::post('search', 'Web\LogController@search')->name('live_search.action');
    Route::delete('myproductsDeleteAll', 'Web\LogController@deleteAll')->name('delete.all');
    Route::get('/', [
        'as' => 'logs',
        'uses' => 'Web\LogController@index'
    ]);
    Route::get('/all', [
        'as' => 'all',
        'uses' => 'Web\LogController@getAllLogs'  
    ])->middleware('admin');

    Route::delete('delete/{id}', 'Web\LogController@delete')->name('logs.delete');
});

Route::group(['prefix' => 'statistics'], function () {
    Route::get('/', [
        'as' => 'statistics',
        'uses' => 'Web\StatisticController@index'
    ]);
});

//Social Login
Route::get('/login', 'Web\AppController@getLogin' )->name('login')->middleware('guest');
Route::get( '/login/{social}', 'Web\AuthenticationController@getSocialRedirect' )->middleware('guest');
Route::get( '/login/{social}/callback', 'Web\AuthenticationController@getSocialCallback' )->middleware('guest');

Auth::routes(['verify' => true]);
Route::get('/home', 'Web\HomeController@index');
