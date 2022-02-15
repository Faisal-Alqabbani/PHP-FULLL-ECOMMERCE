<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController; 
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryConroller;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;


use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;

// user controllers

use App\Http\Controllers\User\WishListController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CashController;
use App\Models\User;



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

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

// =========> all admin routes <========
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout')->middleware('auth:admin');

// =========> admin profile routes <===========
Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile')->middleware('auth:admin');
Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit')->middleware('auth:admin');
Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store')->middleware('auth:admin');
// Admin Password
Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password')->middleware('auth:admin');
Route::post('/admin/udpate/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password')->middleware('auth:admin');


// ==========================================================
// ==========================================================
// =================    USER ALL ROUTES     =================
// ==========================================================
// ==========================================================






Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard')->middleware('auth:admin');



Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');

// home page
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'ChangeUserPassword'])->name('change.password');
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');



// ==========================================================
// ==========================================================
// =================   Admin brand route     ================
// ==========================================================
// ==========================================================
Route::middleware(['auth:admin'])->group(function(){
    
    Route::prefix('brand')->group(function(){
        Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
        Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
        Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
    
    });
    
    // ==========================================================
    // ==========================================================
    // =================       Category      ====================
    // ==========================================================
    // ==========================================================
    Route::prefix('category')->group(function(){
        Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
        Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
        Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
    
        // all Subcategory Routes
        Route::get('/sub/view', [SubCategoryConroller::class, 'SubCategoryView'])->name('all.subcategory');
        Route::post('/sub/store', [SubCategoryConroller::class, 'SubCategoryStore'])->name('subcategory.store');
        Route::get('sub/edit/{id}', [SubCategoryConroller::class, 'SubCategoryEdit'])->name('subcategory.edit');
        Route::post('/sub/update', [SubCategoryConroller::class, 'SubCategoryUpdate'])->name('subcategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryConroller::class, 'SubCategoryDelete'])->name('subcategory.delete');
    
        // Admin Sub->sub Category All Routes 
    
        // get subcategory by ajax
        Route::get('/subcategory/ajax/{category_id}', [SubCategoryConroller::class, 'GetSubcategory']);
        Route::get('/subsubcategory/ajax/{subcategory_id}', [SubCategoryConroller::class, 'GetSubSubcategory']);
        // 
        Route::get('/sub/sub/view', [SubCategoryConroller::class, 'SubSubCategoryView'])->name('all.subsubcategory');
        Route::post('/sub/sub/store', [SubCategoryConroller::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
        Route::get('sub/sub/edit/{id}', [SubCategoryConroller::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
        Route::post('sub/sub/update', [SubCategoryConroller::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
        Route::get('sub/sub/delete/{id}', [SubCategoryConroller::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');
    });
    
    Route::prefix('product')->group(function(){
        Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
        Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
        Route::get('/manage', [ProductController::class, 'ProductManage'])->name('manage-product');
        Route::get('/edit/{id}', [ProductController::class, 'ProductEdit'])->name('product.edit');
        Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');
        Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('product-image-update');
        // product-thmbnail-update
        Route::post('/thmbnail/update', [ProductController::class, 'ThmbnailImageUpdate'])->name('product-thmbnail-update');
        Route::get('/image/delete/{id}', [ProductController::class, 'MultiDelete'])->name('product.multiImage.delete');
        
        Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
        Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
        Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
    });
    
    // ==========================================================
    // ==========================================================
    // =================     Slider Routes ======================
    // ==========================================================
    // ==========================================================
    
    Route::prefix('slider')->group(function(){
        Route::get('/view', [SliderController::class, 'SliderView'])->name('manage-slider');
        Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');
        Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
        Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');
        Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
    });


    // Coupon routes Started here
    Route::prefix('coupons')->group(function(){
    Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon');
        Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');
        Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
        Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
        Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
    });

        // Coupon routes Started here
    Route::prefix('shipping')->group(function(){
        // ship division 
        Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');
        Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');
        Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');
        Route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');
        Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');

        // ship district.
        Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');
        Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
        Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');
        Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');
        Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');


        // ship district.
        Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('manage-state');
        Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');
        Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');
        Route::post('/state/update/{id}', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');
        Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');

        // ajax to get this

    });
});










   // ==========================================================
    // ==========================================================
    // =================       frontend all routes      =========
    // ==========================================================
    // ==========================================================
// Multi Language All Routes //
Route::get('/language/arabic', [LanguageController::class, 'Arabic'])->name('arabic.language');
Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');


// frontend porduct details page Url
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);


// Product tags routes
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

// frontend subcategory wise

Route::get('/category/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);
// subsubcateogry wise products.
Route::get('/subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubSubCatWiseProduct']);
//  prodcut view model Id
Route::get('/product/view/model/{id}', [IndexController::class, 'ProductViewModel']);
//  Add To Cart Routes

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// get min cart 
Route::get('/product/min/cart', [CartController::class, 'GetMinCart']);

// remove from minicart
Route::get('/minicart/product-remove/{id}', [CartController::class, 'RemoveItemMiniCart']);
// route add to wishlist
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishList']);

   // cart routes
   Route::get('/mycart', [CartPageController::class, 'MyCartView'])->name('mycart');
   Route::get('/get-cart-product', [CartPageController::class, 'GetCartProduct']);  
   Route::get('/cart-remove/{id}', [CartPageController::class, 'CartRemove']);
   Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']); 
   Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);
   // Frontend Coupon Option.
    Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
    Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
    Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
    // checkout routes
    Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
    Route::post('/checkout/store', [CartController::class, 'CheckoutStore'])->name('checkout.store');

    Route::get('/distict/ajax/{division_id}', [ShippingAreaController::class, 'DistrictAjax']);
    Route::get('/state/ajax/{district_id}', [ShippingAreaController::class, 'StateAjax']);
   


// Protected routes
Route::group(['prefix' => 'user', 'middleware' => ['user','auth'], 'namespace' => 'User'], 
function(){
   Route::get('/wishlist', [WishListController::class, 'ViewWishlist'])->name('wishlist');
   Route::get('/get-wishlist-product', [WishListController::class, 'GetWishlistProduct']);
   Route::get('/wishlist-remove/{id}', [WishListController::class, 'WishlistRemove']); 
   Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name("stripe.order"); 
   Route::post('/cash/order', [CashController::class, 'CashOrder'])->name("cash.order"); 
   Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name("my.orders"); 
   Route::get('/order_details/{order_id}', [AllUserController::class, 'OrderDetails']); 
});
