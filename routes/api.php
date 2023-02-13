<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\OrderController as ControllersOrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// admin
Route::group(['prefix' => 'admin'], function () {

    Route::post('/send_mail', [OrderController::class, 'sendMail']);

    // Categories //
    Route::get('/list-category', [CategoryController::class, 'categories'])->name('categories');

    // Products thuoc categories //
    Route::get('/list-product/{id}', [ProductController::class, 'categories_products'])->name('categories_products');

    // Products all //
    Route::get('/all-product', [ProductController::class, 'all_products'])->name('all_products');

    // images thuoc Products //
    Route::get('/images-product/{id}', [ProductController::class, 'images_products'])->name('images_products');

    // images đại diện Products //
    Route::get('/images_avatar_products/{id}', [ProductController::class, 'images_avatar_products'])->name('images_avatar_products');

    // search
    Route::get('all-product/', [ProductController::class, 'search'])->name('search');

    //product-details
    Route::get('/product/{id}',[ProductController::class,'product_detail']);

    // role
    Route::get('/list-user', [RoleController::class, 'index'])->name('index');
    Route::get('/add-user', [RoleController::class, 'create'])->name('create');
    Route::post('/add-user', [RoleController::class, 'store'])->name('store');
    Route::get('/edit-user/{id}', [RoleController::class, 'edit']);
    Route::post('/update-user/{id}', [RoleController::class, 'update']);
    Route::get('/delete-user/{id}', [RoleController::class, 'destroy']);
});

Route::middleware('api')->prefix('order')->group(function () {
    Route::post('/',[OrderController::class,'orderProduct']);
});
Route::post('/order_',[OrderController::class,'orderProduct']);


Route::middleware('api')->prefix('/')->group(function (){
    Route::auth();
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/register',[AuthController::class,'register']);
    // profile-user
    Route::get('/profile-user', [UserController::class, 'profile_user'])->name('profile_user');
    // update-profile-user
    Route::put('/update-profile', [UserController::class, 'update_profile'])->name('update_profile');


});
// Route::middleware('api')->post('login',[AuthController::class,'login']);
