<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

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
Route::post('/postlogin', 'AuthController@postlogin')->name('postlogin');
Route::get('/login', 'AuthController@index')->name('login');
Route::get('/logout', 'AuthController@logout');

Route::post('/postregister', 'AuthController@postregister')->name('postregister');
Route::get('/register', 'AuthController@register')->name('register');

Route::post('reset-password', 'AuthController@submitResetPasswordForm')->name('reset.password.post');
Route::post('lupa-password', 'AuthController@submitForgetPasswordForm')->name('forget.password.post'); 
Route::get('reset-password/{token}', 'AuthController@showResetPasswordForm')->name('reset.password.get');
Route::get('lupa-password', 'AuthController@showForgetPasswordForm')->name('forget.password.get');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/products', 'ProductController@index')->name('products');
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/details/{id}/{slug}', 'DetailsController@index')->name('details');
Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');
Route::post('/checkout/callback', 'CartController@callback')->name('midtrans-callback');

Route::middleware(['auth','checkrole: 3'])->group(function () {
    Route::post('/cart/delete/{id}', 'CartController@delete');
    Route::post('/cart/{id}/{slug}', 'CartController@store');
    Route::get('/cart/dataprovinsi', 'CartController@province');
    Route::post('/checkout', 'CartController@storePayment')->name('checkout');

    Route::post('/account', 'AccountController@update');
    
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::get('/shipping', 'CartController@buy')->name('buy');
    Route::get('/success', 'CartController@success')->name('success');
    Route::get('/account', 'AccountController@account')->name('account');
    Route::get('/history', 'TransactionController@history')->name('history');
    Route::get('/transactions/{id}/details', 'TransactionController@show')->name('transaction-details');

});
Route::get('/rajaongkir/provinsi/{idProvinsi}/distrik', 'CartController@district');
Route::get('/rajaongkir/ekspedisi/{ekspedisi_terpilih}/distrik/{distrik_terpilih}/berat/{total_weight}', 'CartController@options');

Route::middleware(['auth','checkrole: 2'])->group(function () {
    Route::post('/dashboard/reports/periode', 'DashboardController@periode');
    Route::post('/dashboard/reports/date', 'DashboardController@date');
    Route::get('/dashboard/reports', 'DashboardController@report')->name('dashboard-reports');
});

Route::middleware(['auth','checkrole: 1,2'])->group(function () {
    Route::post('/dashboard/account', 'AccountController@update');

    Route::post('/dashboard/products/store', 'DashboardProductController@store')->name('dashboard-product-store');
    Route::post('/dashboard/products/{id}', 'DashboardProductController@update');
    Route::get('/dashboard/products/{id}/hapus', 'DashboardProductController@delete');
    Route::get('/dashboard/products/{id}/details', 'DashboardProductController@details')->name('dashboard-product-details');
    Route::get('/dashboard/products/add', 'DashboardProductController@add')->name('dashboard-product-add');
    Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-products');

    Route::post('/dashboard/admins/{id}/status', 'AccountController@adminUpdateStatus');
    Route::post('/dashboard/admins/{id}/ubah', 'AccountController@adminUpdate');
    Route::post('/dashboard/admins/store', 'AccountController@adminStore')->name('dashboard-admin-store');
    Route::get('/dashboard/admins/create', 'AccountController@adminCreate')->name('dashboard-admin-add');
    Route::get('/dashboard/admins', 'AccountController@adminList')->name('dashboard-admins');

    Route::post('/dashboard/{id}/status', 'AccountController@updateStatusUser');
    Route::get('/dashboard/customers', 'AccountController@customerList')->name('dashboard-customers');

    Route::post('/dashboard/transactions/{id}/resi', 'DashboardTransactionController@resi');
    Route::post('/dashboard/transactions/{id}/detail', 'DashboardTransactionController@update');
    Route::get('/dashboard/transactions/{id}/customer', 'DashboardTransactionController@detailCustomer');
    Route::get('/dashboard/transactions/{id}/detail', 'DashboardTransactionController@show')->name('dashboard-transaction-details');
    Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transactions');

    Route::get('/dashboard/account', 'AccountController@adminAccount')->name('dashboard-account');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});




