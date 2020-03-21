<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->group(function() {
    Route::get('user', function (Request $request) {
        return $request->user();
    });
    Route::post('user', 'InvoiceController@check');
    Route::post('logout', 'AuthController@logout');
    Route::put('changeContact', 'UserController@changeContact');
    Route::patch('changePassword', 'UserController@changePassword');
    //Admin
    Route::get('allorders', 'OrderAdminController@index');
    Route::get('allusers', 'UserController@index');
    Route::get('userprofile/{id}', 'UserController@show');
    Route::delete('deleteuser/{id}', 'UserController@destroy');       
    Route::post('invoice/{id}', 'InvoiceController@add'); 
    Route::post('order/{id}', 'OrderAdminController@store');    
    Route::put('order/{user}/{order}', 'OrderrController@update');
    //Ares
    Route::post('ares', 'AresController@check');
    //Invoice
    Route::post('invoice', 'InvoiceController@store');
    Route::put('invoice', 'InvoiceController@update');
    //Product
    Route::post('product', 'ProductController@store');
    //Category
    Route::post('category', 'CategoryController@store');
    Route::delete('category/{category}', 'CategoryController@destroy');
    //Orders
    Route::get('orders', 'OrderrController@index');
    Route::get('order/{order}', 'OrderrController@show');
    Route::post('order', 'OrderrController@store');
    Route::put('order/{order}', 'OrderrController@update');
    Route::post('order/{order}/confirm', 'OrderrController@confirm');
    Route::delete('order/{order}', 'OrderrController@destroy');
    //Amount
    Route::put('amount/{amount}', 'AmountController@update');
    Route::delete('amount/{amount}', 'AmountController@destroy');
});


Route::post('category/{category}', 'CategoryController@update');
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('contact', 'ContactController@store');

Route::get('cat', 'CategoryController@load');

//Category
Route::get('categories', 'CategoryController@index');
Route::get('category/{category}', 'CategoryController@show');
//Product
Route::get('products', 'ProductController@index');



