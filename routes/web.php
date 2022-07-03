<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {return view('auth.login');});
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'confirm'=>false, // Password Confirm
 ]);

 Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware'=>'IsAdmin'], function(){
        //USER ROUTES
        Route::resource('users', UserController::class,['names'=>[
            'index'=>'users.index',   
            'store'=>'users.store',
        ],'only' => ['index', 'store']]);
        Route::post('/users/update_user',[UserController::class, 'update_user']);
    });
    //CATEGORY ROUTES
    Route::resource('categories', CategoryController::class,['names'=>[
        'index'=>'category.index',   
        'store'=>'category.store',
    ],'only' => ['index', 'store']]);
    Route::post('/categories/update_category',[CategoryController::class, 'update_category']);

    //PRODUCTS ROUTES
    Route::resource('products', ProductController::class,['names'=>[
        'index'=>'products.index',   
        'store'=>'products.store',
    ],'only' => ['index', 'store']]);

    Route::post('/products/update_products',[ProductController::class, 'update_products']);
    Route::post('/products/delete_product',[ProductController::class, 'delete_product']);
});
