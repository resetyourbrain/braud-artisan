<?php

//Route untuk authentikasi user 
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => ['jwt.verify']], function() { 
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('payload', 'AuthController@payload');
    });
});

//Tambah route dibawah sini

//taruh Route di luar sini untuk yang tidak perlu authentikasi
//Route::get('data', 'DataController@data');

//Buat beberapa route:group untuk hak akses yang berbeda2 pisahkan dengan | jika ada 2 atau lebih hak akses yang dapat menggunakannya
//Route::group(['middleware' => ['jwt.verify:<HAK_AKSES>']], function ()) {....
Route::group(['middleware' => ['jwt.verify']], function() { 

    //taruh Route di dalam sini untuk yang perlu authentikasi
    //Route::<Method>('<NamaURL>', '<NamaController>@<NamaFunction>');
    Route::get('test', 'TestController@index');
    Route::post('test', 'TestController@store');
    Route::get('test/{id}', 'TestController@show')->where('id', '[0-9]+');
    Route::put('test/{id}', 'TestController@update')->where('id', '[0-9]+');
    Route::delete('test/{id}', 'TestController@destroy')->where('id', '[0-9]+');  
    Route::get('test-detail', 'TestController@indexWithDetail');
    Route::get('test-detail/{id}', 'TestController@showWithDetail')->where('id', '[0-9]+');


    Route::get('customer/data', 'CustomerController@index');
    Route::post('customer/data', 'CustomerController@store');
    Route::get('customer/data/{id}', 'CustomerController@show');
    Route::put('customer/data/{id}', 'CustomerController@update');
    Route::delete('customer/data/{id}', 'CustomerController@destroy');

    Route::get('produk/data', 'ProdukController@index');
    Route::post('produk/data', 'ProdukController@store');
    Route::get('produk/data/{id}', 'ProdukController@show');
    Route::put('produk/data/{id}', 'ProdukController@update');
    Route::delete('produk/data/{id}', 'ProdukController@destroy');
    Route::get('produk/detail', 'ProdukController@indexWithDetail');
    Route::get('produk/detail/{id}', 'ProdukController@showWithDetail')->where('id', '[0-9]+');

    Route::get('harga/data', 'HargaController@index');
    Route::post('harga/data', 'HargaController@store');
    Route::get('harga/data/{id}', 'HargaController@show');
    Route::put('harga/data/{id}', 'HargaController@update');
    Route::delete('harga/data/{id}', 'HargaController@destroy');
    Route::post('harga/many', 'HargaController@storeMany');
    Route::delete('harga/customer/{id_customer}', 'HargaController@deleteFromCust');
    Route::get('harga/customer/{id_customer}', 'HargaController@showFromCust');

    Route::get('satuan/data', 'SatuanController@index');
    Route::post('satuan/data', 'SatuanController@store');
    Route::get('satuan/data/{id}', 'SatuanController@show');
    Route::put('satuan/data/{id}', 'SatuanController@update');
    Route::delete('satuan/data/{id}', 'SatuanController@destroy');

    Route::get('kategori/data', 'KategoriController@index');
    Route::post('kategori/data', 'KategoriController@store');
    Route::get('kategori/data/{id}', 'KategoriController@show');
    Route::put('kategori/data/{id}', 'KategoriController@update');
    Route::delete('kategori/data/{id}', 'KategoriController@destroy');

    Route::get('order/data', 'OrderController@index');
    Route::post('order/data', 'OrderController@store');
    Route::get('order/data/{id}', 'OrderController@show');
    Route::put('order/data/{id}', 'OrderController@update');
    Route::delete('order/data/{id}', 'OrderController@destroy');
    Route::get('order/detail', 'OrderController@indexWithDetail');
    Route::get('order/detail/{id}', 'OrderController@showWithDetail');
    Route::get('order/kredit', 'OrderController@indexCredit');

    Route::get('kredit/data', 'KreditController@index');
    Route::post('kredit/data', 'KreditController@store');
    Route::get('kredit/data/{id}', 'KreditController@show');
    Route::put('kredit/data/{id}', 'KreditController@update');
    Route::delete('kredit/data/{id}', 'KreditController@destroy');

});