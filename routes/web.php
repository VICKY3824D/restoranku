<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use \App\Http\Controllers\CheckoutController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return redirect()->route('menu');
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
Route::middleware('role:Admin|cashier')->group(function () {
    Route::post('orders/settlement/{order}', [OrderController::class, 'settlement'])
        ->name('orders.settlement');
});

// only admin can modify categories, roles, users, and items
Route::middleware('role:Admin')->group(function () {
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::resource('roles', RoleController::class)->names('admin.roles');
    Route::resource('users', UserController::class)->names('admin.users');
    Route::resource('items', ItemController::class)->names('admin.items');
});

Route::middleware( \App\Http\Middleware\RoleMiddleware::class . ':Admin|cashier|chef')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('orders', OrderController::class)->names('admin.orders');

    Route::post('order/{order}', [OrderController::class, 'updateStatus'])
    ->name('orders.updateStatus');

});

// only chef can process order
Route::middleware('role:chef')->group(function () {

    Route::post('order/cooked/{order}', [OrderController::class, 'cooked'])
    ->name('orders.cooked');

});

require __DIR__.'/auth.php';



