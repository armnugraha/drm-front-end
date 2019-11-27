<?php

Route::group(['prefix' => 'v1', 'namespace' => 'Api', 'as' => 'api.', 'middleware' => []], function () {
    Route::post('products/search', ['as' => 'products.search', 'uses' => 'ProductsController@search']);
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'middleware' => []], function () {
    Route::post('create_transaction', ['as' => 'transactions.create', 'uses' => 'TransactionsController@storeTransaction']);
    Route::get('/getTransaction/{invoice}', ['as' => 'transactions.get_transaction', 'uses' => 'TransactionsController@getTransaction']);

    Route::get('/getAllProduct', ['as' => 'products.get_all_product', 'uses' => 'ProductsController@getAllProduct']);
    Route::get('/product-otomatis', ['as' => 'products.product_otomatis', 'uses' => 'ProductsController@storeProduct']);
    Route::get('/getProduct/{barcode}', ['as' => 'products.get_product', 'uses' => 'ProductsController@getProduct']);
});
