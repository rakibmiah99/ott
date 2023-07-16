<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FilmIndustryController;
use App\Http\Controllers\Admin\HomeCategoryController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\MoviesController;
use App\Http\Controllers\Admin\MoviesPartController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\SubscriptionCouponController;
use App\Http\Controllers\Admin\HomeCategoryVisibilityController;
use App\Http\Controllers\Admin\FeatureMoviesController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\GlobalController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserFavouriteController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\SubscriptionController as Client_Subscription;
use App\Http\Controllers\API\MovieController as Client_MovieController;
use App\Http\Controllers\API\CategoryController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return auth('sanctum')->user();
});


Route::get('menu', [GlobalController::class, 'GetMenu'])->name('get.menu');
Route::prefix('/home')->group(function (){
   Route::get('load-first', [HomeController::class, 'FirstLoad'])->name('home.load.first');
   Route::get('load-second', [HomeController::class, 'SecondLoad'])->name('home.load.second');
});

Route::prefix('/category')->group(function (){
    Route::get('load-first', [CategoryController::class, 'FirstLoad'])->name('category.load.first');
 });
 





Route::post('/login', [AuthController::class, 'Login']);
Route::post('/login-with-otp', [AuthController::class, 'LoginWithOtp']);
Route::post('/add-or-remove-to-favourite',[UserFavouriteController::class, 'AddOrToFavourite']);
Route::get('/search',[SearchController::class, 'Search']);
Route::get('/subscription',[Client_Subscription::class, 'Get']);
Route::middleware('auth:sanctum')->get('/subscription/{subscription_id}', [Client_Subscription::class, 'GetSingle'])->name('user.subscription.single');
Route::/*middleware('auth:sanctum')->*/get('/apply-coupon/{subscription_id}/{coupon}', [Client_Subscription::class, 'ApplyCoupon'])->name('user.subscription.single');
Route::middleware('auth:sanctum')->post('/user-favourite',[UserFavouriteController::class, 'UserWiseFavourite']);
Route::middleware('auth:sanctum')->get('/movie/{name}', [Client_MovieController::class, 'data']);


//Admin Panel
Route::prefix('/admin/account')->group(function (){
    Route::post('/login', [AdminController::class, 'Login']);
});

Route::middleware('admin_auth')->prefix('admin')->group(function(){
   //Film Industry
    Route::prefix('film-industry')->group(function (){
        Route::get('/get', [FilmIndustryController::class, 'GetAll'])->name('film.get.all');
        Route::get('/get-data', [FilmIndustryController::class, 'GetSingle'])->name('film.get.single');
        Route::post('/save', [FilmIndustryController::class, 'Save'])->name('film.save');
        Route::post('/update', [FilmIndustryController::class, 'Update'])->name('film.update');
        Route::delete('/delete', [FilmIndustryController::class, 'Delete'])->name('film.delete');
    });
   //Home Categories
    Route::prefix('home-category')->group(function (){
        Route::get('/get', [HomeCategoryController::class, 'GetAll'])->name('home.category.get.all');
        Route::get('/get-data', [HomeCategoryController::class, 'GetSingle'])->name('home.category.get.single');
        Route::post('/save', [HomeCategoryController::class, 'Save'])->name('home.category.save');
        Route::post('/update', [HomeCategoryController::class, 'Update'])->name('home.category.update');
        Route::delete('/delete', [HomeCategoryController::class, 'Delete'])->name('home.category.delete');
        Route::post('/rearrange', [HomeCategoryController::class, 'Rearrange'])->name('home.category.rearrange');
    });

    Route::prefix('main-category')->group(function (){
        Route::get('/get', [MainCategoryController::class, 'GetAll'])->name('main.category.get.all');
    });

    //Sub Category
    Route::prefix('sub-category')->group(function (){
        Route::get('/get', [SubCategoryController::class, 'GetAll'])->name('sub.category.get.all');
        Route::get('/get-data', [SubCategoryController::class, 'GetSingle'])->name('sub.category.get.single');
        Route::post('/save', [SubCategoryController::class, 'Save'])->name('sub.category.save');
        Route::post('/update', [SubCategoryController::class, 'Update'])->name('sub.category.update');
        Route::delete('/delete', [SubCategoryController::class, 'Delete'])->name('sub.category.delete');
    });

    //Movies
    Route::prefix('movies')->group(function (){
        Route::get('/get', [MoviesController::class, 'GetAll'])->name('movie.get.all');
        Route::get('/get-selectable', [MoviesController::class, 'GetSelectable'])->name('movie.get.selectable');
        Route::get('/get-data', [MoviesController::class, 'GetSingle'])->name('movie.get.single');
        Route::post('/save', [MoviesController::class, 'Save'])->name('movie.save');
        Route::post('/update', [MoviesController::class, 'Update'])->name('movie.update');
        Route::delete('/delete', [MoviesController::class, 'Delete'])->name('movie.delete');
    });

    //Movies
    Route::prefix('movies-part')->group(function (){
        Route::get('/get', [MoviesPartController::class, 'GetAll'])->name('movie.part.get.all');
        Route::get('/get-data', [MoviesPartController::class, 'GetSingle'])->name('movie.part.get.single');
        Route::post('/save', [MoviesPartController::class, 'Save'])->name('movie.part.save');
        Route::post('/update', [MoviesPartController::class, 'Update'])->name('movie.part.update');
        Route::delete('/delete', [MoviesPartController::class, 'Delete'])->name('movie.part.delete');
    });

    Route::prefix('subscription-plan')->group(function (){
        Route::get('/get', [SubscriptionController::class, 'GetAll'])->name('subscription.plan.get.all');
        Route::get('/get-data', [SubscriptionController::class, 'GetSingle'])->name('subscription.plan.get.single');
        Route::post('/save', [SubscriptionController::class, 'Save'])->name('subscription.plan.save');
        Route::post('/update', [SubscriptionController::class, 'Update'])->name('subscription.plan.update');
        Route::delete('/delete', [SubscriptionController::class, 'Delete'])->name('subscription.plan.delete');
    });

    Route::prefix('subscription-coupon')->group(function (){
        Route::get('/get', [SubscriptionCouponController::class, 'GetAll'])->name('coupon.get.all');
        Route::get('/get-data', [SubscriptionCouponController::class, 'GetSingle'])->name('coupon.get.single');
        Route::post('/save', [SubscriptionCouponController::class, 'Save'])->name('coupon.save');
        Route::post('/update', [SubscriptionCouponController::class, 'Update'])->name('coupon.update');
        Route::delete('/delete', [SubscriptionCouponController::class, 'Delete'])->name('coupon.delete');
    });

    Route::prefix('home-category-visibility')->group(function (){
        Route::get('/get', [HomeCategoryVisibilityController::class, 'GetAll'])->name('home.visibility.get.all');
        Route::get('/get-data', [HomeCategoryVisibilityController::class, 'GetSingle'])->name('home.visibility.single');
        Route::post('/save', [HomeCategoryVisibilityController::class, 'Save'])->name('home.visibility.save');
        Route::post('/update', [HomeCategoryVisibilityController::class, 'Update'])->name('home.visibility.update');
        Route::delete('/delete', [HomeCategoryVisibilityController::class, 'Delete'])->name('home.visibility.delete');
        Route::post('/rearrange', [HomeCategoryVisibilityController::class, 'Rearrange'])->name('home.visibility.rearrange');
    });

    Route::prefix('feature-movies')->group(function (){
        Route::get('/get', [FeatureMoviesController::class, 'GetAll'])->name('feature.get.all');
        Route::get('/get-data', [FeatureMoviesController::class, 'GetSingle'])->name('feature.single');
        Route::post('/save', [FeatureMoviesController::class, 'Save'])->name('feature.save');
        Route::post('/update', [FeatureMoviesController::class, 'Update'])->name('feature.update');
        Route::delete('/delete', [FeatureMoviesController::class, 'Delete'])->name('feature.delete');
        Route::post('/rearrange', [FeatureMoviesController::class, 'Rearrange'])->name('feature.rearrange');
    });
});
