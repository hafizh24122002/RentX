<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardBuyerController;
use App\Http\Controllers\DashboardSellerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\OrderController;
use App\Models\Review;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// NEED TO FIX THESE ROUTES LATER
Route::get('/', [PageController::class, 'index']);

# routing untuk nampilin property secara umum
Route::get('/search', [PageController::class, 'search']);

#routing untuk detail property
Route::get('/property/{property:slug}', [PageController::class, 'show']);

# routing untuk halaman login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

# routing untuk halaman register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');

Route::post('/register', [RegisterController::class, 'store']);

Route::get('/payment/{order:id}', [OrderController::class, 'payment'])->middleware('auth');

Route::put('/payment/{order:id}', [OrderController::class, 'paymentAccepted']);

# routing untuk halaman buyer Verification

//BUYER
#routing landing page/dashboard buyer
Route::get('/dashboard', [DashboardBuyerController::class, 'index'])->middleware('auth');

Route::get('/dashboard/{user:username}/edit', [DashboardBuyerController::class, 'edit'])->middleware('auth');

Route::put('/dashboard/{user:username}', [DashboardBuyerController::class, 'update']);

Route::get('/dashboard/history', [DashboardBuyerController::class, 'history'])->middleware('auth');

Route::get('/dashboard/change-password', [DashboardBuyerController::class, 'viewChangePassword'])->middleware('auth');

Route::put('/dashboard/change-password/{user:username}', [DashboardBuyerController::class, 'changePassword']);

Route::get('/dashboard/become-seller', [DashboardBuyerController::class, 'becomeSeller'])->middleware('auth');

Route::post('/dashboard/become-seller', [DashboardBuyerController::class, 'requestToAdmin']);

# routing untuk halaman buyer Riview/Komentar
Route::get('/buyers/review/{property:slug}',[ReviewController::class,'index'])->middleware('auth');#untuk di halaman detail property
Route::get('/buyers/review/dashboard/{order:id}',[ReviewController::class,'indexForDashboardBuyer'])->middleware('auth');#untuk di halaman dashboard buyer

// Route::get('/buyers/review/dashboard/{order:id}', [ReviewController::class, 'indexForDashboardBuyer'])->middleware('auth');#lihat review
Route::post('/buyers/review/{property:slug}',[ReviewController::class,'store']);
Route::put('/buyers/review/{id}',[ReviewController::class,'update']);

# routing untuk order
Route::post('/buyers/order/{property:slug}', [OrderController::class,'store']);

Route::get('/dashboard/order/stop/{order:id}', [OrderController::class, 'stop'])->middleware('auth');

// SELLER
# routing untuk halaman Dashboard Seller
Route::get('/seller/dashboard', [DashboardSellerController::class, 'index'])->middleware('seller');

Route::post('/seller/dashboard', [DashboardSellerController::class, 'store'])->middleware('seller');

Route::get('/seller/dashboard/{property:slug}/edit', [DashboardSellerController::class, 'edit'])->middleware('seller');

Route::get('/seller/dashboard/profile/{user:username}/edit', [DashboardSellerController::class, 'editProfile'])->middleware('seller');

Route::put('/seller/dashboard/profile/{user:username}', [DashboardSellerController::class, 'updateProfile'])->middleware('seller');

Route::get('/seller/dashboard/create', [DashboardSellerController::class, 'create'])->middleware('seller');

Route::get('/seller/dashboard/checkSlug', [DashboardSellerController::class, 'checkSlug'])->middleware('seller');

Route::put('/seller/dashboard/{property:slug}', [DashboardSellerController::class, 'update'])->middleware('seller');

Route::delete('/seller/dashboard/{property:slug}', [DashboardSellerController::class, 'destroy'])->middleware('seller');

Route::get('/seller/dashboard/history', [DashboardSellerController::class, 'history'])->middleware('seller');

Route::get('/seller/dashboard/change-password', [DashboardSellerController::class, 'viewChangePassword'])->middleware('seller');

Route::put('/seller/dashboard/change-password/{user:username}', [DashboardSellerController::class, 'changePassword'])->middleware('seller');

# permintaan sewa
Route::get('/seller/dashboard/orders',[DashboardSellerController::class, 'showOrder'])->middleware('seller');

#seller order action
Route::post('/seller/dashboard/orders/{order:id}', [DashboardSellerController::class, 'orderAction'])->middleware('seller');

# riwayat transaksi

// ADMIN AREA
Route::get('/admin', [DashboardAdminController::class, 'index'])->middleware('admin');

Route::get('/admin/daftarSeller', [DashboardAdminController::class, 'listSellers'])->middleware('admin');

Route::get('/admin/daftarBuyer', [DashboardAdminController::class, 'listBuyers'])->middleware('admin');

Route::get('/admin/requestUpgrade', [DashboardAdminController::class, 'requestUpgrade'])->middleware('admin');

Route::get('/admin/requestUpgrade/{user:username}', [DashboardAdminController::class, 'showRequest'])->middleware('admin');

Route::put('/admin/requestUpgrade/{user:username}', [DashboardAdminController::class, 'acceptRequest'])->middleware('admin');

Route::delete('/admin/requestUpgrade/{user:username}', [DashboardAdminController::class, 'rejectRequest'])->middleware('admin');
