<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use \App\Http\Controllers\CheckoutController;

Route::get('/', function () {
    return;
});

Route::get('/menu', [MenuController::class, 'index'])
    ->name('menu');

Route::group([
                'controller' => MenuController::class,
                'prefix' => 'cart',
                'as' => 'cart.' // Ini akan menambahkan prefix 'cart.' ke semua nama route dalam grup
            ], function () {
                Route::get('/', 'cart');
                Route::post('/add', 'addToCart')->name('add');
                Route::post('/remove', 'removeCart')->name('remove');
                Route::post('/update', 'updateCart')->name('update');
                Route::get('/clear', 'clearCart')->name('clear');
});



Route::group([
    'controller' => CheckoutController::class,
    'prefix' => 'checkout',
    'as' => 'checkout.'
], function () {

    Route::get('/', 'checkout');
    Route::post('/store', 'storeOrder')
        ->name('store');
    Route::get('/success/{orderCode}/', 'orderSuccess')
        ->name('success');

});

// admin routes

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('categories', CategoryController::class)->names('admin.categories');
Route::resource('items', ItemController::class)->names('admin.items');
Route::resource('roles', RoleController::class)->names('admin.roles');
Route::resource('orders', OrderController::class)->names('admin.orders');
Route::resource('users', UserController::class)->names('admin.users');





