<?php

use App\Http\Controllers\AuthController;
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
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    //route for Role(After login and Register)
    Route::get('checkRole', [AuthController::class, 'checkRole'])->name('auth.checkRole');

    // admin routes
    Route::group(['prefix' => 'admin', 'middleware' => 'admin_auth'], function () {

    });

    // user routes
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        
    });
});
