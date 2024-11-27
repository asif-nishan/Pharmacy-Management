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



//Route::get('/vendors','VendorController@index');
//Route::get('/vendors/create','VendorController@create');
//Route::post('/vendors','VendorController@store');
//Route::put('/vendors','VendorController@update');
//Route::get('/vendors/{vendor}','VendorController@show');
//Route::get('/vendors/{vendor}/edit','VendorController@edit');

Route::get('login', 'AuthController@index');
Route::post('post-login', 'AuthController@postLogin');
Route::get('registration', 'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration');
Route::get('dashboard', 'AuthController@dashboard');
Route::get('logout', 'AuthController@logout');
Route::get('login', 'AuthController@index')->name('login');
Route::post('post-login', 'AuthController@postLogin');
Route::get('registration', 'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration');
Route::get('dashboard', 'AuthController@dashboard');
Route::get('logout', 'AuthController@logout');

Route::resource('vendors', 'VendorController');
Route::resource('brands', 'BrandController');
Route::get('/products/stocks', 'ProductController@stocks');
Route::resource('products', 'ProductController');
Route::resource('sales', 'SaleController');
Route::post('/sales/product-info', 'SaleController@getProductInfo');
Route::post('/sales/purchase-info', 'SaleController@getStockByPurchase');

Route::resource('customers', 'CustomerController');
//Route::resource('product-prices', 'ProductPriceController');

Route::get('/manage-prices', 'ProductPriceController@managePrice');
Route::get('/product-prices/{product}', 'ProductPriceController@index');
Route::get('/product-prices/{product}/create', 'ProductPriceController@create');
Route::post('/product-prices', 'ProductPriceController@store');
Route::get('/purchases', 'PurchaseController@index');
Route::get('/purchases/invoices', 'PurchaseController@invoices');
Route::get('/purchases/invoices/{invoice}', 'PurchaseController@show');
Route::get('/purchases/invoices/edit/{invoice}', 'PurchaseController@edit');
Route::post('/purchases', 'PurchaseController@store');

Route::get('/reports/monthly', 'SaleReportController@monthly');
Route::get('/reports/daily', 'SaleReportController@daily');
