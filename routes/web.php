<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
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
//public login register
Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'homePage', 301);
    Route::get('/homePage', [AuthController::class, 'home'])->name('auth.homePage');
    Route::get('/loginPage', [AuthController::class, 'login'])->name('auth.loginPage');
    Route::get('/registerPage', [AuthController::class, 'register'])->name('auth.registerPage');

    Route::get('/books', [PublicController::class, 'index'])->name('public.book');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    //route for Role(After login and Register)
    Route::get('checkRole', [AuthController::class, 'checkRole'])->name('auth.checkRole');

    // admin routes
    Route::group(['prefix' => 'admin', 'middleware' => 'admin_auth'], function () {
        Route::get('dashboard', [AdminController::class, 'adminDash'])->name('admin.dashboard');
        Route::prefix('category')->group(function () {
            Route::get('/', [AdminController::class, 'categoryIndex'])->name('admin.category.index');
            Route::get('/create', [AdminController::class, 'categoryCreate'])->name('admin.category.create');
            Route::post('/store', [AdminController::class, 'categoryStore'])->name('admin.category.store');
            Route::get('/edit/{id}', [AdminController::class, 'categoryEdit'])->name('admin.category.edit');
            Route::post('/update/{id}', [AdminController::class, 'categoryUpdate'])->name('admin.category.update');
            Route::get('/delete/{id}', [AdminController::class, 'categoryDelete'])->name('admin.category.delete');
        });
        Route::prefix('author')->group(function () {
            Route::get('/', [AdminController::class, 'authorIndex'])->name('admin.author.index');
            Route::get('/create', [AdminController::class, 'authorCreate'])->name('admin.author.create');
            Route::post('/store', [AdminController::class, 'authorStore'])->name('admin.author.store');
            Route::get('/edit/{id}', [AdminController::class, 'authorEdit'])->name('admin.author.edit');
            Route::post('/update/{id}', [AdminController::class, 'authorUpdate'])->name('admin.author.update');
            Route::get('/delete/{id}', [AdminController::class, 'authorDelete'])->name('admin.author.delete');
        });

        Route::prefix('order')->group(function () {
            Route::get('/', [AdminController::class, 'orderIndex'])->name('admin.order.index');
            Route::get('/detail/{id}', [AdminController::class, 'orderDetail'])->name('admin.order.detail');
            Route::get('/accept/{id}', [AdminController::class, 'orderAccept'])->name('admin.order.accept');
            Route::get('/decline/{id}', [AdminController::class, 'orderDecline'])->name('admin.order.decline');
        });
    });

    // user routes
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {

    });
});
