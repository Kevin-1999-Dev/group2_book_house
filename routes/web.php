<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
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
//public pages for user and admin
Route::redirect('/', 'homePage', 301);
Route::get('/homePage', [PublicController::class, 'home'])->name('public.index');
Route::get('/books', [PublicController::class, 'index'])->name('public.book');
Route::get('/ebooks', [PublicController::class, 'ebook'])->name('public.ebook');
Route::get('/book/{id}', [PublicController::class, 'show_book'])->name('public.book_detail');
Route::get('/ebook/{id}', [PublicController::class, 'show_ebook'])->name('public.ebook_detail');
Route::get('/Contact', [PublicController::class, 'feedback'])->name('public.contact_us');
Route::post('/Contact', [PublicController::class, 'storeFeedback'])->name('feedbacks.store');

//login register
Route::middleware(['admin_auth'])->group(function () {
    Route::get('/loginPage', [AuthController::class, 'login'])->name('auth.loginPage');
    Route::get('/registerPage', [AuthController::class, 'register'])->name('auth.registerPage');
});

Route::middleware(['auth'])->group(function () {
    //route for Role(After login and Register)
    Route::get('checkRole', [AuthController::class, 'checkRole'])->name('auth.checkRole');

    // admin routes
    Route::group(['prefix' => 'admin', 'middleware' => 'admin_auth'], function () {
        Route::get('dashboard', [AdminController::class, 'adminDash'])->name('admin.dashboard');
        // Admin Profile
        Route::prefix('profile')->group(function () {
            Route::get('password', [AdminController::class, 'changePasswordPage'])->name('admin.changePasswordPage');
            Route::post('password/change', [AdminController::class, 'changePassword'])->name('admin.changePassword');
        });
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

        Route::prefix('book')->group(function () {
            Route::get('/', [AdminController::class, 'bookIndex'])->name('admin.book.index');
            Route::get('/detail/{id}', [AdminController::class, 'bookDetail'])->name('admin.book.detail');
            Route::get('/create', [AdminController::class, 'bookCreate'])->name('admin.book.create');
            Route::post('/store', [AdminController::class, 'bookStore'])->name('admin.book.store');
            Route::get('/edit/{id}', [AdminController::class, 'bookEdit'])->name('admin.book.edit');
            Route::post('/update/{id}', [AdminController::class, 'bookUpdate'])->name('admin.book.update');
            Route::get('/delete/{id}', [AdminController::class, 'bookDelete'])->name('admin.book.delete');
        });
        Route::prefix('ebook')->group(function () {
            Route::get('/', [AdminController::class, 'ebookIndex'])->name('admin.ebook.index');
            Route::get('/detail/{id}', [AdminController::class, 'ebookDetail'])->name('admin.ebook.detail');
            Route::get('/create', [AdminController::class, 'ebookCreate'])->name('admin.ebook.create');
            Route::post('/store', [AdminController::class, 'ebookStore'])->name('admin.ebook.store');
            Route::get('/edit/{id}', [AdminController::class, 'ebookEdit'])->name('admin.ebook.edit');
            Route::post('/update/{id}', [AdminController::class, 'ebookUpdate'])->name('admin.ebook.update');
            Route::get('/delete/{id}', [AdminController::class, 'ebookDelete'])->name('admin.ebook.delete');
        });
    });

    // user routes
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('dashboard', [UserController::class, 'userDash'])->name('user.dashboard');
    });
});
