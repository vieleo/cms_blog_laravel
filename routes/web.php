<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrderController;
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
Route::get('/role-user', function () {
    return view('Role_User');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','AdminRole'])->name('dashboard');

Route::get('/', [HomeController::class, 'show'])->name('show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin
Route::group(['prefix' => 'admin'], function () {
    // Categories //
    Route::get('/list-category', [CategoryController::class, 'index'])->name('index');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('create');
    Route::post('/add-category', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit']);
    Route::post('/update-category/{id}', [CategoryController::class, 'update']);
    Route::get('/delete-category/{id}', [CategoryController::class, 'destroy']);
    Route::get('/test', [CategoryController::class, 'getModel'])->name('getModel');

    // Products //
    Route::get('/list-product', [ProductController::class, 'index'])->name('index');
    Route::get('/add-product', [ProductController::class, 'create'])->name('create');
    Route::post('/add-product', [ProductController::class, 'store'])->name('store');
    Route::get('/show-product/{id}', [ProductController::class, 'show'])->name('show');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
    Route::post('/update-product/{id}', [ProductController::class, 'update']);
    Route::get('/delete-product/{id}', [ProductController::class, 'destroy']);

    // list cart
    Route::get('/cart', [OrderController::class, 'index'])->name('index');
    Route::get('/show-detail-cart/{id}', [OrderController::class, 'show'])->name('show');
    Route::post('/update-cart/{id}', [OrderController::class, 'update'])->name('update');



    // role
    Route::get('/list-user', [RoleController::class, 'index'])->name('index');
    Route::get('/add-user', [RoleController::class, 'create'])->name('create');
    Route::post('/add-user', [RoleController::class, 'store'])->name('store');
    Route::get('/edit-user/{id}', [RoleController::class, 'edit']);
    Route::post('/update-user/{id}', [RoleController::class, 'update']);
    Route::get('/delete-user/{id}', [RoleController::class, 'destroy']);
})->middleware(['auth', 'verified','AdminRole']);

// multiple lang
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'vi', 'cn'])) {
        abort(404);
    }
    session()->put('locale', $locale);
    return redirect()->back();
});

require __DIR__.'/auth.php';
