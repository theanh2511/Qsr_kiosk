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
$namespace = '\App\Http\Controllers';
Route::middleware(['locale'])->group(function () {
    Route::get('/', 'OrderController@welcome');
    Route::get('/login', 'OrderController@login');
    Route::get('/order', 'OrderController@index');
    Route::get('/select-language', 'OrderController@getLanguage');
    Route::get('/catalogs', 'OrderController@getCatalog');

    Route::get('/your-cart', 'OrderController@getYourCart');
    Route::post('/save/{cmd}', 'CommonController@saveMultiple');
});

Route::get('language/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

//Router list of master
Route::group(
    ['namespace' => $namespace, 'prefix' => 'list'],
    function () {
        Route::get('/product', 'ProductController@listData');
        Route::get('/catalog', 'CommonController@listData');
        Route::get('/quotation', 'CommonController@listData');
        Route::get('/discount', 'CommonController@listData');
        Route::get('/sale', 'CommonController@listData');
        Route::get('/user', 'UserController@listData');
    }
);

//Router master
Route::group(
    ['namespace' => $namespace, 'prefix' => 'master'],
    function () {
        Route::get('/product', 'ProductController@getDetail');
        Route::get('/product-detail/{primary_key?}', 'ProductController@getViewer');
        Route::post('/product/save', 'ProductController@save');
        Route::post('/product/delete', 'CommonController@delete');
        Route::post('/product/search', 'QuotationController@search');

        Route::get('/catalog', 'CatalogController@getDetail');
        Route::post('/catalog/save', 'CommonController@save');
        Route::post('/catalog/delete', 'CommonController@delete');

        Route::get('/quotation', 'QuotationController@getDetail');
        Route::post('/quotation/save', 'CommonController@saveMultiDatatable');
        Route::post('/quotation/delete', 'CommonController@delete');

        Route::get('/discount', 'DiscountController@getDetail');
        Route::post('/discount/save', 'CommonController@saveMultiDatatable');
        Route::post('/discount/delete', 'CommonController@delete');
    }
);

//Router common
Route::group(
    ['namespace' => $namespace, 'prefix' => 'common'],
    function () {
        Route::post('/link/linksession', 'CommonController@linksession');
        Route::post('/link/session-forget', 'CommonController@forgetSession');
        Route::post('/session-add-to-cart', 'CommonController@sessionAddToCart');

        Route::post('/upload-multiple-file', 'CommonController@uploadMultipleFiles');
        Route::post('/remove-image', 'CommonController@removeImage');
    }
);