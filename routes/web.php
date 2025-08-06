<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

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


Route::get('/checkout', function () {
    return view('customer.checkout');
})->name('checkout');


