<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisMenuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\JenisPesananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
    return view('frond.home');
});
Route::get('/about', function(){
    return view('frond.about');
});
Route::get('coffees', [MenuController::class, 'frondcoffees'])->name('frond.coffees');
Route::get('/blog', function(){
    return view('frond.blog');
});
Route::post('/update-cart', [BerandaController::class, 'updateCart'])->name('update.cart');
Route::get('/', [BerandaController::class, 'index']);
Route::get('add-to-cart/{id}',[BerandaController::class, 'addToCart'])->name('add.to.cart');
Route::get('/shop_cart', [BerandaController::class, 'cart'])->name('shop_cart');
Route::get('/cart', [BerandaController::class, 'cart'])->name('cart');
Route::get('/detail_cart/{id}', [BerandaController::class, 'detail']);
Route::get('/remove-from-cart/{id}', [BerandaController::class, 'removeFromCart'])->name('remove.from.cart');

Route::get('apimenu', [MenuController::class, 'menuApi']);
Route::get('apimenu/{id}', [MenuController::class, 'menuApidetail']);

Route::group(['middleware' => ['auth','checkActive', 'role:admin|manager|staff']], function(){
//prefix dan grouping mengelompokkan routing ke satu jenis route
Route::prefix('admin')->group(function(){
Route::get('/user', [UserController::class, 'index']);
Route::post('/user/{user}/activate', 
[UserController::class, 'activate'])->name('admin.user.activate');
Route::get('/profile', [UserController::class, 'showProfile']);
Route::patch('/profile/{id}', [UserController::class, 'update']);
//patch atau put dua syntax yang sama untuk digunakan sebagai pengubah data
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/jenis_menu', [JenisMenuController::class, 'index']);
Route::post('/jenis_menu/store', [JenisMenuController::class, 'store']);

Route::resource('menu', MenuController::class);

Route::get('/jenis_pesanan', [JenisPesananController::class, 'index']);
Route::post('/jenis_pesanan/store', [JenisPesananController::class, 'store']);

Route::resource('pesanan', PesananController::class);

Route::resource('ulasan', UlasanController::class);
Route::get('ulasan/create/{pesanan_id}', [UlasanController::class, 'create'])->name('ulasan.create');

Route::resource('users', UsersController::class);

});
    Route::prefix('admin')->group(function(){
        Route::get('/user', [UserController::class, 'index']);
        Route::post('/user/{user}/activate', [UserController::class, 'activate'])->name('admin.user.activate');
        Route::get('/profile', [UserController::class, 'showProfile']);
        Route::patch('/profile/{id}', [UserController::class, 'update']);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/jenis_menu', [JenisMenuController::class, 'index']);
        Route::post('/jenis_menu/store', [JenisMenuController::class, 'store']);
        Route::resource('menu', MenuController::class);
        Route::get('/jenis_pesanan', [JenisPesananController::class, 'index']);
        Route::post('/jenis_pesanan/store', [JenisPesananController::class, 'store']);
        Route::resource('pesanan', PesananController::class);
        Route::resource('ulasan', UlasanController::class);
        Route::resource('users', UsersController::class);
    });
});
Auth::routes();
Route::get('ulasan/create/{pesanan_id}', [UlasanController::class, 'create'])->name('ulasan.create');
Route::post('/ulasan/store', [UlasanController::class, 'store'])->name('ulasan.store');
Route::get('/', [HomeController::class, 'index'])->name('home');
