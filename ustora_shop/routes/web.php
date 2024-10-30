<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;
//client
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postLogin'])->name('login.post');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'postRegister']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/productDetail/{id}', [ShopController::class, 'productDetail'])->name('productDetail');
//search
Route::get('/search', [ShopController::class, 'search'])->name('search');
//cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'addCart'])->name('cart.add');
Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.increase-qty');
Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.decrease-qty');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'removeItemCart'])->name('cart.item.remove');
Route::delete('/cart/removeAll', [CartController::class, 'removeAllCart'])->name('cart.removeAllCart');
//wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist', [WishlistController::class, 'addWishlist'])->name('wishlist.add');
Route::delete('/wishlist/removeWishlist/{rowId}', [WishlistController::class, 'removeItemWishlist'])->name('wishlist.itemRemove');
Route::delete('wishlist/removeAll', [WishlistController::class, 'removeAll'])->name('wishlist.removeAll');
Route::post('wishlist/moveToCart/{rowId}', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/place_an_order', [CartController::class, 'place_an_order'])->name('cart.place.an.order');
Route::get('/order-confirmation', [CartController::class, 'order_confirmation'])->name('cart.order.confirmation');
Route::get('/view-order', [OrderController::class, 'view_order'])->name('view.order');
Route::get('/view-order/{id}/detail', [OrderController::class, 'show_order'])->name('show.order');
Route::put('/cancel-order',[OrderController::class, 'order_cancel'])->name('cancel.order');









//admin

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'postLogin'])->name('admin.postLogin');
Route::get('/admin/sign-out', [AdminController::class, 'logout'])->name('admin.logout');
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    //danh mục
    Route::resource('/category', CategoryController::class);
    Route::get('/category-trash', [CategoryController::class, 'trash'])->name('category.trash');
    Route::get('/category-restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::get('/category-forceDelete/{id}', [CategoryController::class, 'forceDelete'])->name(name: 'category.forceDelete');
    //sản phẩm
    Route::resource('/product', ProductController::class);
    Route::get('/product-trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::get('/product-restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::get('/product-forceDelete/{id}', [ProductController::class, 'forceDelete'])->name(name: 'product.forceDelete');

    //order
    Route::resource('/order',OrderController::class);
    Route::put('/order/update-status', [OrderController::class, 'update'])->name('order.update.status');


});
