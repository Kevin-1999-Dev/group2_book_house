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
        //profile
        Route::prefix('profile')->group(function () {
            Route::get('password', [AdminController::class, 'changePasswordPage'])->name('admin.changePasswordPage');
            Route::post('password/change', [AdminController::class, 'changePassword'])->name('admin.changePassword');
            Route::get('details', [AdminController::class, 'profilePage'])->name('admin.details');
            Route::get('editPage', [AdminController::class, 'editPage'])->name('admin.editPage');
            Route::post('update/{id}', [AdminController::class, 'updateAdmin'])->name('admin.updateAdmin');
        });
        //category
        Route::prefix('category')->group(function () {
            Route::get('/', [AdminController::class, 'categoryIndex'])->name('admin.category.index');
            Route::get('/create', [AdminController::class, 'categoryCreate'])->name('admin.category.create');
            Route::post('/store', [AdminController::class, 'categoryStore'])->name('admin.category.store');
            Route::get('/edit/{id}', [AdminController::class, 'categoryEdit'])->name('admin.category.edit');
            Route::post('/update/{id}', [AdminController::class, 'categoryUpdate'])->name('admin.category.update');
            Route::get('/delete/{id}', [AdminController::class, 'categoryDelete'])->name('admin.category.delete');
            Route::get('/export', [AdminController::class, 'exportCategory'])->name('admin.category.export');
            Route::post('/import', [AdminController::class, 'importCategory'])->name('admin.category.import');
        });
        //author
        Route::prefix('author')->group(function () {
            Route::get('/', [AdminController::class, 'authorIndex'])->name('admin.author.index');
            Route::get('/create', [AdminController::class, 'authorCreate'])->name('admin.author.create');
            Route::post('/store', [AdminController::class, 'authorStore'])->name('admin.author.store');
            Route::get('/edit/{id}', [AdminController::class, 'authorEdit'])->name('admin.author.edit');
            Route::post('/update/{id}', [AdminController::class, 'authorUpdate'])->name('admin.author.update');
            Route::get('/delete/{id}', [AdminController::class, 'authorDelete'])->name('admin.author.delete');
        });
        //payment
        Route::prefix('payment')->group(function () {
            Route::get('/', [AdminController::class, 'paymentIndex'])->name('admin.payment.index');
            Route::get('/create', [AdminController::class, 'paymentCreate'])->name('admin.payment.create');
            Route::post('/store', [AdminController::class, 'paymentStore'])->name('admin.payment.store');
            Route::get('/edit/{id}', [AdminController::class, 'paymentEdit'])->name('admin.payment.edit');
            Route::post('/update/{id}', [AdminController::class, 'paymentUpdate'])->name('admin.payment.update');
            Route::get('/delete/{id}', [AdminController::class, 'paymentDelete'])->name('admin.payment.delete');
        });
        //order
        Route::prefix('order')->group(function () {
            Route::get('/', [AdminController::class, 'orderIndex'])->name('admin.order.index');
            Route::get('/detail/{id}', [AdminController::class, 'orderDetail'])->name('admin.order.detail');
            Route::post('/update/{id}', [AdminController::class, 'orderUpdate'])->name('admin.order.update');
        });
        //book
        Route::prefix('book')->group(function () {
            Route::get('/', [AdminController::class, 'bookIndex'])->name('admin.book.index');
            Route::get('/create', [AdminController::class, 'bookCreate'])->name('admin.book.create');
            Route::post('/store', [AdminController::class, 'bookStore'])->name('admin.book.store');
            Route::get('/edit/{id}', [AdminController::class, 'bookEdit'])->name('admin.book.edit');
            Route::post('/update/{id}', [AdminController::class, 'bookUpdate'])->name('admin.book.update');
            Route::get('/delete/{id}', [AdminController::class, 'bookDelete'])->name('admin.book.delete');
        });
        //ebook
        Route::prefix('ebook')->group(function () {
            Route::get('/', [AdminController::class, 'ebookIndex'])->name('admin.ebook.index');
            Route::get('/create', [AdminController::class, 'ebookCreate'])->name('admin.ebook.create');
            Route::post('/store', [AdminController::class, 'ebookStore'])->name('admin.ebook.store');
            Route::get('/edit/{id}', [AdminController::class, 'ebookEdit'])->name('admin.ebook.edit');
            Route::post('/update/{id}', [AdminController::class, 'ebookUpdate'])->name('admin.ebook.update');
            Route::get('/delete/{id}', [AdminController::class, 'ebookDelete'])->name('admin.ebook.delete');
        });

        Route::prefix('user')->group(function () {
            Route::get('/', [AdminController::class, 'userIndex'])->name('admin.user.index');
            Route::get('/edit/{id}', [AdminController::class, 'userEdit'])->name('admin.user.edit');
            Route::post('/update/{id}', [AdminController::class, 'userUpdate'])->name('admin.user.update');
            Route::get('/delete/{id}', [AdminController::class, 'userDelete'])->name('admin.user.delete');
        });

        Route::prefix('feedback')->group(function () {
            Route::get('/', [AdminController::class, 'feedbackIndex'])->name('admin.feedback.index');
            Route::get('/detail/{id}', [AdminController::class, 'feedbackDetail'])->name('admin.feedback.detail');
            Route::get('/delete/{id}', [AdminController::class, 'feedbackDelete'])->name('admin.feedback.delete');
        });
    });

    // user routes
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('dashboard', [UserController::class, 'userDash'])->name('user.dashboard');

        Route::prefix('profile')->group(function () {
            Route::get('password', [UserController::class, 'changePasswordPage'])->name('user.changePasswordPage');
            Route::post('password/change', [UserController::class, 'changePassword'])->name('user.changePassword');
            Route::get('details', [UserController::class, 'profilePage'])->name('user.details');
            Route::get('editPage', [UserController::class, 'editPage'])->name('user.editPage');
            Route::post('update/{id}', [UserController::class, 'updateUser'])->name('user.updateUser');
        });
    });
});
