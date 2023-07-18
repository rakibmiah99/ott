<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
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
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserFavouriteController;
use App\Http\Controllers\API\SubscriptionController as API_SubscriptionController;
use App\Http\Controllers\API\MovieController as API_MovieController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\SslCommerzPaymentController;



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

Route::get('/test', [HomeController::class, 'test'])->name('test');

Route::get('/', [HomeController::class, 'Page'])->name('user.home');
Route::get('/account', [AuthController::class, 'Page'])->name('account');
Route::get('/favourite', [UserFavouriteController::class, 'Page'])->name('user.favourite');
Route::get('/subscription', [API_SubscriptionController::class, 'Page'])->name('user.subscription');
Route::post('/payment', [PaymentController::class, 'PaymentProcess'])->name('user.payment');
Route::get('/movie/{name?}', [API_MovieController::class, 'Page'])->name('client.movie');
Route::get('/category/{main}', [CategoryController::class, 'Page']);
Route::get('/category/{main}/{sub}', [CategoryController::class, 'Page']);
// frontend category
Route::get('/{name}', [CategoryController::class, 'CategoryPage'])->name('category.page');

Route::get('admin/login', [AdminController::class, 'LoginPage'])->name('admin.login');
Route::middleware('admin_auth_web')->prefix('admin')->group(function (){
    Route::get('/', [MainCategoryController::class, 'Page'])->name('dashboard');
    Route::get('/main-category', [MainCategoryController::class, 'Page'])->name('admin.main.category');
    Route::get('/sub-category', [SubCategoryController::class, 'Page'])->name('admin.sub.category');
    Route::get('/film-industry', [FilmIndustryController::class, 'Page'])->name('admin.film.industry');
    Route::get('/home-category', [HomeCategoryController::class, 'Page'])->name('admin.home.category');
    Route::get('/movie', [MoviesController::class, 'Page'])->name('admin.movie');
    Route::get('/movie-part', [MoviesPartController::class, 'Page'])->name('admin.movie.part');
    Route::get('/subscription', [SubscriptionController::class, 'Page'])->name('admin.subscription');
    Route::get('/subscription-coupon', [SubscriptionCouponController::class, 'Page'])->name('admin.subscription.coupon');
    Route::get('/home-category-visibility', [HomeCategoryVisibilityController::class, 'Page'])->name('admin.home.category.visibility');
    Route::get('/feature-movies', [FeatureMoviesController::class, 'Page'])->name('admin.feature.movie');
});




// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
