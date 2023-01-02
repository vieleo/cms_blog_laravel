<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin-category
Route::group(['prefix'=>'admin'], function(){
                        // Categories //
    // index-category
    Route::get('/list-category', [CategoryController::class, 'index'])->name('index');
    // Create Category
    Route::get('/add-category', [CategoryController::class, 'create'])->name('create');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('store');
    // Update Category
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit']);
    Route::post('/update-category/{id}', [CategoryController::class, 'update']);
    // Delete user
    Route::get('/delete-category/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
    // test eloquent
    Route::get('/test', [CategoryController::class, 'getModel'])->name('getModel');
    // Route::get('/connect', 'CategoryController@store')->name('store');

                        // Products //
    // index-product
    Route::get('/list-product', [ProductController::class, 'index'])->name('index');
    // Create product
    Route::get('/add-product', [ProductController::class, 'create'])->name('create');
    Route::post('/add-product', [ProductController::class, 'store'])->name('store');
    // Update product
    Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
    Route::post('/update-product/{id}', [ProductController::class, 'update']);
    // Delete user
    Route::get('/delete-product/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);
    // test eloquent
});

require __DIR__.'/auth.php';
