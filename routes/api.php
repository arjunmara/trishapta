<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getAllCategoriesWithSubCategories', ['uses' => 'Backend\RestApiController@getCategoriesWithSubCategories']);
Route::get('/getAllCategories', ['uses' => 'Backend\RestApiController@getCategories']);
Route::get('/getSubCategoriesByCategoryID/{id}', ['uses' => 'Backend\RestApiController@getSubCategoriesByCategoryId']);
Route::get('/getAllProducts', ['uses' => 'Backend\RestApiController@getAllProducts']);
Route::get('/getProductDetail/{id}', ['uses' => 'Backend\RestApiController@getProductDetail']);
Route::get('/getProductByCategoryId/{id}', ['uses' => 'Backend\RestApiController@getProductByCategoryId']);
Route::get('/getProductBySubCategoryId/{id}', ['uses' => 'Backend\RestApiController@getProductBySubCategoryId']);
Route::get('/homeslider', ['uses' => 'Backend\RestApiController@homeSlider']);
Route::get('/about', ['uses' => 'Backend\RestApiController@about']);
Route::get('/contact', ['uses' => 'Backend\RestApiController@contact']);
Route::get('/privacy-policy', ['uses' => 'Backend\RestApiController@privacyPolicy']);

//Clients
Route::post('/createClient', ['uses' => 'Backend\RestApiController@createClient']);
Route::post('/updateClient/{id}', ['uses' => 'Backend\RestApiController@updateClient']);
Route::post('/updateClientPassword/{id}', ['uses' => 'Backend\RestApiController@updateClientPassword']);

//Device Registration
Route::post('/createDevice', ['uses' => 'Backend\DeviceController@store']);

