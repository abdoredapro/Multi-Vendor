<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Dashboardd\DashboardController;
use App\Http\Controllers\Front\auth\twoFactorAuthenticationController as AuthTwoFactorAuthenticationController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Test

Route::get('/products', [ProductController::class, 'index'])
->name('products.index');

Route::get('/products/{product:slug}', [ProductController::class, 'show'])
->name('products.show');


Route::resource('/cart', CartController::class);

Route::put('/carts/{cart}', [CartController::class, 'test']);



Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store']);



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

    Route::get('auth/user/2fa', [AuthTwoFactorAuthenticationController::class, 'index'])
    ->name('front.2fa');

    Route::post('currency', [CurrencyConverterController::class, 'store'])
    ->name('currency.store');


    
    Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])
    ->name('auth.socialite.redirect');

    Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])
    ->name('auth.socialite.callback');

    Route::get('/auth/{provider}/user', [SocialController::class, 'index']);


    
    Route::get('orders/{order}/pay',[PaymentsController::class, 'create'])
    ->name('orders.payment.create');

    Route::post('orders/{order}/stripe/payment-intent',[PaymentsController::class, 'createStripePaymentIntent'])
    ->name('stripe.paymentIntent.create');
    

    Route::get('orders/{order}/pay/srtipe/callback',[PaymentsController::class, 'confirm'])
    ->name('stripe.confirm');

    Route::get('/orders/{order}',[OrdersController::class, 'show'])
    ->name('orders.show');
    
// require __DIR__.'/auth.php';


require __DIR__.'/dashboard.php';



