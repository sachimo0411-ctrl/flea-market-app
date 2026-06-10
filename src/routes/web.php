<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
Route::get('/register', [AuthController::class, 'register'])
    ->name('register');

Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::get('/', [ItemController::class, 'index'])
    ->name('items.index');

Route::get('/item/{item_id}', [ItemController::class, 'show'])
    ->name('items.show');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})
    ->middleware('auth')
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/mypage/profile');
})
    ->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back();
})
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/item/{item_id}/like', [LikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('items.like');

Route::post('/item/{item_id}/comment', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('items.comment');

Route::get('/purchase/{item_id}', [PurchaseController::class, 'index'])
    ->middleware('auth')
    ->name('purchase.index');

Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])
    ->middleware('auth')
    ->name('purchase.store');

Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'addressEdit'])
    ->name('address.edit');
Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'addressUpdate'])
    ->name('address.update');

Route::get('/mypage', [ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('profile.index');
Route::get('/mypage/profile', [ProfileController::class, 'edit'])
    ->middleware(['auth'])
    ->name('profile.edit');
Route::patch('/mypage/profile', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::get('/sell', [SellController::class, 'create'])
    ->middleware('auth')
    ->name('sell.create');
Route::post('/sell', [SellController::class, 'store'])
    ->middleware('auth')
    ->name('sell.store');