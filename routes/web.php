<?php

use App\Http\Controllers\Admin\AdditionalController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PhotobookController;
use App\Http\Controllers\Admin\PrintedPhotoController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\trackingcontroller;
use App\Http\Controllers\WeddingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [BookingController::class, 'home'])->name('landing');

Route::get('/portfolio', function () {
    return view('pages.portfolio.index');
})->name('portfolio');

Route::get('/pricelist', function () {
    return view('pages.pricelist.index');
})->name('pricelist.index');

Route::get('/portfolio/Pre-WeddingR&Bjepara', function () {
    return view('pages.portfolio.pre-wedding.index');
})->name('portfolio/pre-wedding');


/* Pricelist and Custom Order */
Route::get('pricelist/wedding', [WeddingController::class, 'index'])
    ->name('pricelist.wedding.index');

Route::get('pricelist/pre-wedding', [BookingController::class, 'prewedding'])
    ->name('pricelist.pre-wedding.index');

Route::get('pricelist/engagement', [BookingController::class, 'engagement'])
    ->name('pricelist.engagement.index');

Route::post('pricelist/post', [BookingController::class, 'orderfirststep']);

Route::get('/custom', [OrderController::class, 'custom'])->name('custom_package');
Route::post('/postcustom', [OrderController::class, 'postcustom'])->name('post-custom');


//CREATE BOOKINGS AND CUSTOM
//1ST STEP
Route::get('pricelist/order', [OrderController::class, 'orderpackage'])
    ->name('pricelist.orderpackage');
//2ND STEP
Route::post('pricelist/postorder', [OrderController::class, 'postCreateStep1'])
    ->name('pricelist.post-order');
//3RD STEP
Route::get('pricelist/order/details', [OrderController::class, 'order'])
    ->name('pricelist.wedding.order');
//4TH STEP
Route::post('/pricelist/detail/order', [OrderController::class, 'kirim']);
//5TH STEP
Route::get('pricelist/order/checkout', [OrderController::class, 'checkout'])
    ->name('pricelist.order.checkout');
//6TH STEP
Route::post('/pricelist/order/checkout/store', [OrderController::class, 'store'])
    ->name('store-booking');
//7TH STEP
Route::get('/payment-confirmation/{id}', [OrderController::class, 'payment'])
    ->name('payment.confirmation');


/* searching */
Route::get('trackingorder', [trackingcontroller::class, 'index'])->name('trackorder');
Route::get('search', [trackingcontroller::class, 'post'])->name('requestorder');

//ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    //ADMIN DASHBOARD
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //ADMIN SEARCH ROUTES
    Route::get('/search', [AdminController::class, 'search'])->name('search');
    Route::get('/search-result', [AdminController::class, 'searchResult'])->name('search-result');
    Route::post('/update-status', [AdminController::class, 'update'])->name('update-status');

    //ADMIN CRUD PACKAGE ROUTES
    Route::resource('paket', PackageController::class)->except('show');
    //ADMIN CRUD PHOTOBOOK ROUTES
    Route::resource('photobook', PhotobookController::class)->except('show');
    //ADMIN CRUD PRINTED PHOTO ROUTES
    Route::resource('printedphoto', PrintedPhotoController::class)->except('show');
    //ADMIN ADDITIONAL FEATURES CRUD
    Route::resource('additionals', AdditionalController::class)->except('show');
    //ADMIN DISCOUNT CRUD
    Route::resource('discount', DiscountController::class)->except('show');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/postpackage', [BookingController::class, 'index']);
Route::post('storepackage', [BookingController::class, 'create']);


//MIDTRANS ENDPOINT
Route::post('/payments/notification', [PaymentController::class, 'notification'])
    ->name('payment.notification');

Route::post('/payments/completed', [PaymentController::class, 'completed'])
    ->name('payment.completed');

Route::post('/payments/unfinished', [PaymentController::class, 'unfinished'])
    ->name('payment.unfinished');

Route::post('/payments/failed', [PaymentController::class, 'failed'])
    ->name('payment.failed');

Route::get('/payments/snap/finished', [PaymentController::class, 'snapFinish'])
    ->name('payment.snap.finished');

Route::get('/payments/snap/unfinished', [PaymentController::class, 'snapUnfinished'])
    ->name('payment.snap.unfinished');

Route::get('/payments/snap/failed', [PaymentController::class, 'snapFailed'])
    ->name('payment.snap.failed');
