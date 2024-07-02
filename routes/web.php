<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ImageController;
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

Route::get('/', [HotelController::class, 'dashboardRoom'])->name('dashboard');

Route::get('/login', function () {
    return view('login');
});
Route::post('/transactions/simpan', [TransactionController::class, 'simpan'])->name('transactions.simpan');
Route::post('/transactions/confirm', [TransactionController::class, 'confirm'])->name('transactions.confirm');
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/about', function () {
    return view('about');
})->name('about');


Route::resource('memberships', MembershipController::class);

Route::resource('hotels', HotelController::class)->only(['index', 'show']);
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::resource('facilities', FacilityController::class)->only(['index', 'show']);
Route::resource('users', UserController::class)->only(['index', 'show']);
// Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
Route::resource('memberships', MembershipController::class)->only(['index', 'show']);
Route::resource('images', ImageController::class)->only(['index', 'show']);
// Route::get("/transactions", [TransactionController::class, "create"])->name("createTran");

Route::middleware(['role:Owner'])->group(function () {
    Route::resource('hotels', HotelController::class)->except(['index', 'show']);
    Route::resource('products', ProductController::class)->except(['index', 'show']);
    Route::resource('facilities', FacilityController::class)->except(['index', 'show']);
    Route::resource('users', UserController::class)->except(['index', 'show']);
    // Route::resource('transactions', TransactionController::class)->except(['index', 'show']);
    Route::resource('memberships', MembershipController::class)->except(['index', 'show']);
    Route::resource('images', ImageController::class)->except(['index', 'show']);
    Route::post('/hotels', [HotelController::class, 'store'])->name('hotels.store');
});

// Route::middleware(['staff'])->group(function () {
//     Route::resource('products', ProductController::class);
//     Route::resource('facilities', FacilityController::class);
//     Route::resource('transactions', TransactionController::class);
//     Route::resource('transaction_details', TransactionDetailController::class);
//     Route::resource('memberships', MembershipController::class);
//     Route::resource('images', ImageController::class);
// });