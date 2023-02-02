<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ListApiController;
use App\Http\Controllers\RoleController;


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
    // Categories //
    Route::get('/list-category', [ListApiController::class, 'categories'])->name('categories');

    // Products thuoc categories //
    Route::get('/list-product/{id}', [ListApiController::class, 'categories_products'])->name('categories_products');

    // images thuoc Products //
    Route::get('/images-product/{id}', [ListApiController::class, 'images_products'])->name('images_products');

    // images đại diện Products //
    Route::get('/images_avatar_products/{id}', [ListApiController::class, 'images_avatar_products'])->name('images_avatar_products');

    // search
    Route::get('/search/{name}', [ListApiController::class, 'search'])->name('search');






    // role
    Route::get('/list-user', [RoleController::class, 'index'])->name('index');
    Route::get('/add-user', [RoleController::class, 'create'])->name('create');
    Route::post('/add-user', [RoleController::class, 'store'])->name('store');
    Route::get('/edit-user/{id}', [RoleController::class, 'edit']);
    Route::post('/update-user/{id}', [RoleController::class, 'update']);
    Route::get('/delete-user/{id}', [RoleController::class, 'destroy']);
});




// Route::controller(AuthController::class)->group(function () {
//     Route::post('login', 'login');
//     Route::post('register', 'register');
//     Route::post('logout', 'logout');
//     Route::post('refresh', 'refresh');

// });

// Route::controller(TodoController::class)->group(function () {
//     Route::get('todos', 'index');
//     Route::post('todo', 'store');
//     Route::get('todo/{id}', 'show');
//     Route::put('todo/{id}', 'update');
//     Route::delete('todo/{id}', 'destroy');
// });


Route::middleware('api')->prefix('/')->group(function (){
    Route::auth();
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/register',[AuthController::class,'register']);
    // profile-user
    Route::get('/profile-user', [ListApiController::class, 'profile_user'])->name('profile_user');
    // update-profile-user
    Route::put('/update-profile', [ListApiController::class, 'update_profile'])->name('update_profile');
    // Route::prefix('user')->group(function (){
    //    Route::get('/index',[CMS\UserController::class,'index'])->name('api.user.index');
    // });

});

// Route::middleware('api')->post('login',[AuthController::class,'login']);
