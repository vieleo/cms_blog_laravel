<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\App;
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
    Route::get('/delete-category/{id}', [CategoryController::class, 'destroy']);
    // test eloquent
    Route::get('/test', [CategoryController::class, 'getModel'])->name('getModel');
    // Route::get('/connect', 'CategoryController@store')->name('store');

                        // Products //
    // index-product
    Route::get('/list-product', [ProductController::class, 'index'])->name('index');
    // Create product
    Route::get('/add-product', [ProductController::class, 'create'])->name('create');
    Route::post('/add-product', [ProductController::class, 'store'])->name('store');
    // show
    Route::get('/show-product/{id}', [ProductController::class, 'show'])->name('show');
    // Update product
    Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
    Route::post('/update-product/{id}', [ProductController::class, 'update']);
    // Delete user
    Route::get('/delete-product/{id}', [ProductController::class, 'destroy']);

                            // role
    Route::get('/list-user', [RoleController::class, 'index'])->name('index');
        // Update product
    Route::get('/edit-user/{id}', [RoleController::class, 'edit']);
    Route::post('/update-user/{id}', [RoleController::class, 'update']);
        // Delete user
    Route::get('/delete-user/{id}', [RoleController::class, 'destroy']);


});

// multiple lang
Route::get('lang/{locale}', function($locale){
    if (! in_array($locale, ['en', 'vi', 'cn'])) {
        abort(404);
    }
    session()->put('locale', $locale);
    return redirect()->back();
});


require __DIR__.'/auth.php';
