<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;

Route::get('/',[ListingController::class,'index']);
Route::get('/hello',[IndexController::class,'show']);

Route::resource('listing', ListingController::class)->only(['index','show'])->middleware('auth');
Route::resource('listing', ListingController::class)->except(['create','edit','update','store','destroy']);
Route::get('login',[AuthController::class, 'create'])->name('login');
Route::post('login',[AuthController::class, 'store'])->name('login.store');
Route::delete('logout',[AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account',UserAccountController::class)->only(['create','store']);

Route::prefix('realtor')
        ->name('realtor.')
        ->middleware('auth')
        ->group(function(){
            Route::name('listing.restore')
            ->put(
                'listing/{listing}/restore',
                [RealtorListingController::class, 'restore']
            )->withTrashed();
            Route::resource('listing',RealtorListingController::class
        )->only(['index', 'destroy','create','edit','update','store']) ->withTrashed();

         Route::resource('listing.image', RealtorListingImageController::class)
            ->only(['create', 'store','destroy']);
        });