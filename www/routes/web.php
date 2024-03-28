<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExchangeController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OpensslController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\IsAuthMiddleware;
use Illuminate\Foundation\Application;
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
Route::get('/', [MainController::class, 'index'])->name('home');
//---------------------------------------------------------------------------
//Cart controller
Route::controller(CartController::class)->group(function () {
    Route::get('/cart/store', 'store')->name('cart.store');
    Route::post('/cart/create', 'create')->name('cart.create');
    Route::get('/cart/delivery', 'delivery')->name('cart.delivery');
    Route::post('/cart/agreement', 'agreement')->name('cart.agreement');
    Route::match(['get', 'post'], '/cart/order', 'order')->name('cart.order');
});
//----------------------------------------------------------------------------
//Main controller
Route::controller(MainController::class)->group(function () {
    Route::post('/main/search', 'search')->name('search');
});
//----------------------------------------------------------------------------
//Product controller
Route::controller(ProductController::class)->group(function () {
    Route::get('/product/{id}', 'view')->name('product');
    Route::get('/parent/{id}', 'parent')->name('parent');
    Route::get('/category/{id}', 'category')->name('category');
});
//---------------------------------------------------------------------------
//WishlistController
Route::controller(WishlistController::class)->group(function () {
    Route::get('/wishlist', 'index')->name('wishlist');
    //    Route::get('/wishlist/get', 'get')->name('wishlist.get');
    //    Route::get('/wishlist/add', 'add')->name('wishlist.add');
    Route::get('/wishlist/remove', 'remove')->name('wishlist.remove');
});
//---------------------------------------------------------------------------
//ProfileController
Route::controller(ProfileController::class)->middleware([IsAuthMiddleware::class])->group(function () {
    Route::get('/client/dashboard', [ProfileController::class, 'index'])->name('profile.dashboard');
    Route::get('/client/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/client/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/client/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/client/callback', [ProfileController::class, 'feedback'])->name('profile.feedback');
    Route::post('/client/send_feedback', [ProfileController::class, 'send_feedback'])
        ->name('profile.send_feedback');
    Route::get('/client/index', [ProfileController::class, 'profile'])->name('profile.profile');
    Route::get('/client/orders', [ClientOrderController::class, 'index'])->name('profile.orders');
    Route::get('/client/orders/{id}/view', [ClientOrderController::class, 'view'])
        ->name('profile.orders.view');
});
//----------------------------------------------------------------------------
//Page is not found
Route::get('/404', function () {
    return view('layouts.404');
});
//------------------------------------------------------------------
//Select language
Route::get('/lang/{lang}', function ($lang) {
    \Illuminate\Support\Facades\Cache::put('lang', $lang);

    return redirect()->back();
});
//------------------------------------------------------------------
Route::prefix('admin')->middleware([IsAuthMiddleware::class, IsAdminMiddleware::class])->group(function () {

})
    ->group(function () {
        Route::resource('/openssl', OpenSslController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/main_categories', MainCategoryController::class);
        Route::resource('/products', AdminProductController::class);
        Route::get('/products/status/{id}', [AdminProductController::class, 'status'])
            ->name('admin.products.status');
        Route::post('/gallery', [AdminProductController::class, 'gallery'])->name('admin.gallery');
        Route::get('/gallery/{id}/delete', [AdminProductController::class, 'delete_gallery'])
            ->name('admin.gallery.delete');
        Route::post('/add_gallery', [AdminProductController::class, 'add_gallery'])->name('admin.add_gallery');
        Route::resource('/orders', OrderController::class);
        Route::resource('/users', UserController::class);
        Route::get('/users/status/{id}', [UserController::class, 'status'])->name('admin.users.status');
        Route::get('/soft_deletes', [UserController::class, 'soft_deletes'])->name('admin.users.soft_deletes');
        Route::post('/soft_delete_user', [UserController::class, 'soft_delete_user'])
            ->name('admin.users.soft_delete_user');
        Route::get('/user/comment/{id}', [UserController::class, 'comment'])->name('admin.users.comment');
        Route::post('/user/add_comment', [UserController::class, 'add_comment'])
            ->name('admin.users.add_comment');
        Route::get('/user/email/{id}', [UserController::class, 'email'])->name('profile.email');
        Route::post('/user/send_email', [UserController::class, 'send_email'])->name('profile.send_email');
        Route::resource('/resources', ResourceController::class)->names('admin.resources');
        Route::resource('/exchange', ExchangeController::class)->names('admin.exchanges');
        Route::resource('/messages', MessageController::class)->names('admin.messages');
    });
//------------------------------------------------------------------
require __DIR__ . '/auth.php';
