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

Route::get('/', 'DashboardController@grid')
    ->name('home');


Route::get('/auth', 'AuthorizeController@auth');
Route::get('/code', 'AuthorizeController@code');

$middlewareRoutes = [];
if (env('APP_ENV') !== 'local')
{
    $middlewareRoutes[] = 'throttle:5,1';
}

Route::middleware($middlewareRoutes)->group(function()
{
    Route::post('/customer-signup', 'CustomerController@signup');
    Route::post('/customer-activate', 'CustomerController@sendAccountActivation');
    Route::put('/customer/{customerId}/add-tag/{tag}', 'CustomerController@addTag');
});