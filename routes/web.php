<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserBidContorller;
use App\Http\Controllers\NotificaionController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\RealtorListingAcceptOfferController;

Route::get('/',[ListingController::class,'index']);
Route::get('/hello',[IndexController::class,'show']);

Route::resource('listing.offer', ListingOfferController::class)
  ->middleware('auth')
  ->only(['store']);
Route::resource('notification',NotificaionController::class)->middleware('auth')->only(['index']);

Route::resource('listing', ListingController::class)->only(['index','show'])->middleware('auth');
Route::resource('listing', ListingController::class)->except(['create','edit','update','store','destroy']);
Route::get('login',[AuthController::class, 'create'])->name('login');
Route::post('login',[AuthController::class, 'store'])->name('login.store');
Route::delete('logout',[AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account',UserAccountController::class)->only(['create','store']);

Route::get('/email/verify', function () {
    return inertia('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');

use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('listing.index')->with('success','Email success verivied');
})->middleware(['auth', 'signed'])->name('verification.verify');

use Illuminate\Http\Request;

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::put(
  'notification/{notification}/seen',
  NotificationSeenController::class
)->middleware('auth')->name('notification.seen');

Route::prefix('realtor')
        ->name('realtor.')
        ->middleware(['auth','verified'])
        ->group(function(){
            Route::name('listing.restore')
            ->put(
                'listing/{listing}/restore',
                [RealtorListingController::class, 'restore']
            )->withTrashed();
            Route::resource('listing',RealtorListingController::class
        )->withTrashed();
            Route::name('offer.accept')->put('offer/{offer}/accept',RealtorListingAcceptOfferController::class );
            Route::resource('listing.image', RealtorListingImageController::class)
                ->only(['create', 'store','destroy']);
        });
Route::prefix('user-bid')
        ->name('user-bid.')
        ->middleware(['auth','verified'])
        ->group(function(){
            Route::resource('', UserBidContorller::class)
                ->only(['index']);
        });