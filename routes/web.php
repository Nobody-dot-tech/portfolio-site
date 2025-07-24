<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminBlogsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'dashboard_blogs'])
    // ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/dashboard', [DashboardController::class, 'dashboard_blogs'])
    // ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::get('/', function () {
//     return view('/dashboard');
// });

Route::resource('blogs', BlogsController::class, ['only' => ['index', 'show']]);

Route::get('comments', [CommentsController::class, 'show'])->name('comments.show');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('comments', CommentsController::class, ['only' => ['store', 'destroy']]);
    Route::get('goods', [UsersController::class, 'goods'])->name('users.goods');
    Route::prefix('goods/{id}')->group(function() {
            Route::post('become_good', [GoodsController::class, 'store'])->name('goods.become_good');
            Route::delete('cancel_good', [GoodsController::class, 'destroy'])->name('goods.cancel_good');
        });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/admin/register', [\App\Http\Controllers\RegisterController::class, 'adminRegisterForm'])->middleware('auth:admin');

Route::post('/admin/register', [\App\Http\Controllers\RegisterController::class, 'adminRegister'])->middleware('auth:admin')->name('admin.register');

Route::get('/admin/login', function () {
    return view('adminLogin'); //blade.php
})->middleware('guest:admin');

Route::post('/admin/login', [\App\Http\Controllers\AdminLoginController::class, 'adminLogin'])->name('admin.login');

Route::get('/admin/logout', [\App\Http\Controllers\AdminLoginController::class, 'adminLogout'])->name('admin.logout');

Route::get('/admin/dashboard', function () {
    return view('adminDashboard');
})->middleware('auth:admin');

Route::group(['middleware' => ['auth:admin']], function () {
    Route::resource('/admin/blogs', \App\Http\Controllers\AdminBlogsController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->names([
        'index' => 'admin-blogs.index',
        'create' => 'admin-blogs.create',
        'store' => 'admin-blogs.store',
        'edit' => 'admin-blogs.edit',
        'update' => 'admin-blogs.update',
        'destroy' => 'admin-blogs.destroy',
    ]);
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


require __DIR__.'/auth.php';
