<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HControllerr;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PController;
use App\Http\Controllers\SController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopProfile;
use App\Http\Controllers\UserProfileController;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

    Route::get('/', [HControllerr::class, 'index'])->name('HomePage');


    Route::get('/product/detail/{product:slug?}', [PController::class, 'show'])->name('product.show');
    Route::get('/product/{slug?}',[SController::class,'index'])->name('product.cate.filter');
    Route::get('/product/tag/{slug?}', [SController::class, 'tag'])->name('product.tag.filter');

    Route::get('/search/{slug?}', [SController::class, 'search'])->name('product.search');

    Route::get('/detail', function () {
        return view('detail');
    })->name('detail');

    Route::group(['middleware' => 'auth',  'prefix' => 'cart',  'as' => 'cart.'],function(){
        Route::get('/', [CartController::class, 'CartPage'])->name('cart');
        Route::get('/{product:id?}', [CartController::class, 'store'])->name('cart.store');
        Route::get('/dec/{cart:id?}', [CartController::class, 'dec'])->name('cart.dec');
        Route::get('/inc/{cart:id?}', [CartController::class, 'inc'])->name('cart.inc');
        Route::get('/dest/{cart:id?}', [CartController::class, 'destroy'])->name('cart.dest');
    });


    Route::get('/fav', function () {
        return view('fav');
    })->name('fav');

    route::get('/shop/profile/{slug?}', [ShopProfile::class, 'show'])->name('shop.show.profile');

    Route::get('/setting', function () {
        return view('dashboard');
    })->name('profile');

Auth::routes();

Route::resource('profile', UserProfileController::class);

// Route::get('/seller', function () {
//     return view('seller.loginseller');
// })->name('loginseller');

// Route::get('/sellerreg', function () {
//     return view('seller.regisseller');
// })->name('regisseller');

Route::group(['middleware' => ['auth','CheckLevel:admin,seller'],  'prefix' => 'seller',  'as' => 'seller.'],function(){
    Route::resource('shop-profile', ShopController::class);
});

//Store-IMG
Route::post('profile/image',[UserProfileController::class, 'storeImage']);
Route::post('shop-profile/image',[ShopController::class, 'storeImage']);


Route::get('/profileseller', function () {
    return view('seller.profile');
})->name('profileseller');

Route::get('/profileC', function () {
    return view('profilecust');
})->name('profile.cust');


Route::get('/setting', function () {
    return view('setting');
})->name('setting');

Route::get('/editprofile', function () {
    return view('profileedit-cust');
})->name('editprofile');

Route::get('/createprofile', function () {
    return view('create-profile');
})->name('create-profile');

Route::get('/profileedit', function () {
    return view('profile.profile-edit');
})->name('profile-edit');



Route::get('checkoutdetail', [OrderController::class, 'index'])->name('checkout-detail');
Route::get('checkoutdetail/payment', [OrderController::class, 'payment'])->name('checkout-payment');
Route::post('place/order', [OrderController::class, 'storeOrder'])->name('place-order');
Route::get('checkoutdetail/payment/success', [OrderController::class, 'complete'])->name('checkout-complete');


Route::get('/productseller', function () {
    return view('seller.product-seller');
})->name('product-seller');


Route::get('/upcoming', function () {
    return view('upcoming');
})->name('upcoming');

Route::get('/upcomingS', function () {
    return view('seller.upcoming');
})->name('upcomingS');

Route::get('/processed', function () {
    return view('seller.processed');
})->name('processed');

Route::get('/completed', function () {
    return view('seller.complete-order');
})->name('completed');

Route::get('/canceled', function () {
    return view('seller.canceled-order');
})->name('canceled');

Route::get('/report', function () {
    return view('seller.report');
})->name('report');

Route::get('/monthlyreport', function () {
    return view('seller.monthly-report');
})->name('monthly-report');

Route::get('/addproduct', function () {
    return view('seller.add-product');
})->name('add-product');

Route::get('/editproduct', function () {
    return view('seller.edit-product');
})->name('edit-product');