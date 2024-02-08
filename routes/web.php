<?php

use App\Http\Controllers\Frontend\IndoregionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\VoucherController;
use App\Http\Controllers\Backend\RewardController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Middleware\RedirectIfAuthenticated;

use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\RoleController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\RendeemController;

use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\MidtransController;
use App\Http\Controllers\User\AllUserController;

use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\Auth\OauthLoginController;


use App\Http\Controllers\Guest\Frontend\IndexGuestController;
use App\Http\Controllers\Guest\Frontend\CartGuestController;
use App\Http\Controllers\Guest\Frontend\ShopGuestController;

use App\Http\Controllers\Guest\User\WishlistGuestController;
use App\Http\Controllers\Guest\User\CheckoutGuestController;
use App\Http\Controllers\Guest\User\MidtransGuestController;
use App\Http\Controllers\Guest\User\AllGuestController;

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


Route::get('/auth/{provider}', [OauthLoginController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [OauthLoginController::class, 'handleProvideCallback']);

Route::get('/indoregion', [IndoregionController::class, 'index'])->name('indoregion.index');

Route::get('provinces', [IndoregionController::class, 'provinces'])->name('get-provinces');
Route::get('regencies', [IndoregionController::class, 'regencies'])->name('get-regencies');
Route::get('districts', [IndoregionController::class, 'districts'])->name('get-districts');
Route::get('villages', [IndoregionController::class, 'villages'])->name('get-villages');

Route::post('ongkir', [CartController::class, 'check_ongkir'])->name('check_ongkir');
Route::get('cities/{raja_province_id}', [CartController::class, 'getCities'])->name('getCities');

Route::get('/', [IndexController::class, 'Index'])->name('home');


Route::middleware(['auth', 'role:user', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::post('/user/address/store', [UserController::class, 'UserAddressStore'])->name('user.address.store');
    Route::post('/user/address/update', [UserController::class, 'UserAddressEdit'])->name('user.address.update');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
    Route::post('/drendeem/data/store/', [RendeemController::class, 'addToRendeemReward'])->name('rendeem');
}); // Gorup Milldeware End

require __DIR__ . '/auth.php';

/// Admin Dashboard

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashobard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Brand All Route 
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/store/brand', 'StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::post('/update/brand', 'UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');
    });

    // Category All Route 
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    // Category All Route 
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');
        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
    });

    // Color All Route 
    Route::controller(ColorController::class)->group(function () {
        Route::get('/all/color', 'AllColor')->name('all.color');
        Route::get('/add/color', 'AddColor')->name('add.color');
        Route::post('/store/color', 'StoreColor')->name('store.color');
        Route::get('/edit/color/{id}', 'EditColor')->name('edit.color');
        Route::post('/update/color', 'UpdateColor')->name('update.color');
        Route::get('/delete/color/{id}', 'DeleteColor')->name('delete.color');
    });

    // Product All Route 
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('update.product');
        Route::post('/update/product/thumbnail', 'UpdateProductThambnail')->name('update.product.thumbnail');
        Route::post('/update/product/multiimage', 'UpdateProductMultiimage')->name('update.product.multiimage');
        Route::get('/product/multiimg/delete/{id}', 'MulitImageDelelte')->name('product.multiimg.delete');
        Route::get('/product/inactive/{id}', 'ProductInactive')->name('product.inactive');
        Route::get('/product/active/{id}', 'ProductActive')->name('product.active');
        Route::get('/delete/product/{id}', 'ProductDelete')->name('delete.product');
        // For Product Stock
        Route::get('/product/stock', 'ProductStock')->name('product.stock');
    });

    // Slider All Route 
    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'AllSlider')->name('all.slider');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::post('/store/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
    });

    // Banner All Route 
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/store/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
        Route::post('/update/banner', 'UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });

    // Coupon All Route 
    Route::controller(CouponController::class)->group(function () {
        Route::get('/all/coupon', 'AllCoupon')->name('all.coupon');
        Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');
        Route::post('/store/coupon', 'StoreCoupon')->name('store.coupon');
        Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon', 'UpdateCoupon')->name('update.coupon');
        Route::get('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');
    });

    // Voucher All Route 
    Route::controller(VoucherController::class)->group(function () {
        Route::get('/all/voucher', 'AllVoucher')->name('all.voucher');
        Route::get('/add/voucher', 'AddVoucher')->name('add.voucher');
        Route::post('/store/voucher', 'StoreVoucher')->name('store.voucher');
        Route::get('/edit/voucher/{id}', 'EditVoucher')->name('edit.voucher');
        Route::post('/update/voucher', 'UpdateVoucher')->name('update.voucher');
        Route::get('/delete/voucher/{id}', 'DeleteVoucher')->name('delete.voucher');
    });

    // Reward All Route 
    Route::controller(RewardController::class)->group(function () {
        Route::get('/all/reward', 'AllReward')->name('all.reward');
        Route::get('/add/reward', 'AddReward')->name('add.reward');
        Route::post('/store/reward', 'StoreReward')->name('store.reward');
        Route::get('/edit/reward/{id}', 'EditReward')->name('edit.reward');
        Route::post('/update/reward', 'UpdateReward')->name('update.reward');
        Route::post('/update/reward/thumbnail', 'UpdateRewardThumbnail')->name('update.reward.thumbnail');
        Route::post('/update/reward/multiimage', 'UpdateRewardMultiimage')->name('update.reward.multiimage');
        Route::get('/reward/multiimg/delete/{id}', 'MulitImageDelelte')->name('reward.multiimg.delete');
        Route::get('/reward/inactive/{id}', 'RewardInactive')->name('reward.inactive');
        Route::get('/reward/active/{id}', 'RewardActive')->name('reward.active');
        Route::get('/delete/reward/{id}', 'RewardDelete')->name('delete.reward');
    });

    // Shipping Province All Route 
    Route::controller(ShippingAreaController::class)->group(function () {
        // Route::get('/all/province', 'AllProvince')->name('all.province');
        Route::get('/ninja-import', 'NinjaTarif')->name('ninja.alamat');
        Route::get('/import-csv', 'NinjaImport')->name('import.ninja');
        Route::post('/store-import-csv', 'StoreNinjaImport')->name('store.ninja');

        Route::get('/ninja-province', 'NinjaAllProvince')->name('ninja.province');
        Route::get('/import-csv-province', 'NinjaImportProvince')->name('province.ninja');
        Route::post('/store-province-csv', 'StoreNinjaProvince')->name('store.province');

        Route::get('/ninja-regency', 'NinjaAllRegency')->name('ninja.regency');
        Route::get('/import-csv-regency', 'NinjaImportRegency')->name('regency.ninja');
        Route::post('/store-regency-csv', 'StoreNinjaRegency')->name('store.regency');

        Route::get('/ninja-district', 'NinjaAllDistrict')->name('ninja.district');
        Route::get('/import-csv-district', 'NinjaImportDistrict')->name('district.ninja');
        Route::post('/store-district-csv', 'StoreNinjaDistrict')->name('store.district');
    });

    // Shipping District All Route 
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/district', 'AllDistrict')->name('all.district');
    });

    // Shipping Regency All Route 
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/regency', 'AllRegency')->name('all.regency');
        Route::get('/district/ajax/{province_id}', 'GetDistrict');
    });

    // Admin Order All Route 
    Route::controller(OrderController::class)->group(function () {
        Route::get('/pending/order', 'PendingOrder')->name('pending.order');
        Route::get('/admin/order/details/{order_id}', 'AdminOrderDetails')->name('admin.order.details');
        Route::get('/admin/confirmed/order', 'AdminConfirmedOrder')->name('admin.confirmed.order');
        Route::get('/admin/processing/order', 'AdminProcessingOrder')->name('admin.processing.order');
        Route::get('/admin/delivered/order', 'AdminDeliveredOrder')->name('admin.delivered.order');
        Route::get('/pending/confirm/{order_id}', 'PendingToConfirm')->name('pending-confirm');
        Route::get('/confirm/processing/{order_id}', 'ConfirmToProcess')->name('confirm-processing');
        Route::get('/processing/delivered/{order_id}', 'ProcessToDelivered')->name('processing-delivered');
        Route::get('/admin/invoice/download/{order_id}', 'AdminInvoiceDownload')->name('admin.invoice.download');
    });

    // Return Order All Route 
    Route::controller(ReturnController::class)->group(function () {
        Route::get('/return/request', 'ReturnRequest')->name('return.request');
        Route::get('/return/request/approved/{order_id}', 'ReturnRequestApproved')->name('return.request.approved');
        Route::get('/complete/return/request', 'CompleteReturnRequest')->name('complete.return.request');
    });

    // Report All Route 
    Route::controller(ReportController::class)->group(function () {
        Route::get('/report/view', 'ReportView')->name('report.view');
        Route::post('/search/by/date', 'SearchByDate')->name('search-by-date');
        Route::post('/search/by/month', 'SearchByMonth')->name('search-by-month');
        Route::post('/search/by/year', 'SearchByYear')->name('search-by-year');
        Route::get('/order/by/user', 'OrderByUser')->name('order.by.user');
        Route::post('/search/by/user', 'SearchByUser')->name('search-by-user');
    });

    // Active user and vendor All Route 
    Route::controller(ActiveUserController::class)->group(function () {
        Route::get('/all/user', 'AllUser')->name('all-user');
    });

    // Blog Category All Route 
    Route::controller(BlogController::class)->group(function () {
        Route::get('/admin/blog/category', 'AllBlogCateogry')->name('admin.blog.category');
        Route::get('/admin/add/blog/category', 'AddBlogCateogry')->name('add.blog.categroy');
        Route::post('/admin/store/blog/category', 'StoreBlogCateogry')->name('store.blog.category');
        Route::get('/admin/edit/blog/category/{id}', 'EditBlogCateogry')->name('edit.blog.category');
        Route::post('/admin/update/blog/category', 'UpdateBlogCateogry')->name('update.blog.category');
        Route::get('/admin/delete/blog/category/{id}', 'DeleteBlogCateogry')->name('delete.blog.category');
    });

    // Blog Post All Route 
    Route::controller(BlogController::class)->group(function () {
        Route::get('/admin/blog/post', 'AllBlogPost')->name('admin.blog.post');
        Route::get('/admin/add/blog/post', 'AddBlogPost')->name('add.blog.post');
        Route::post('/admin/store/blog/post', 'StoreBlogPost')->name('store.blog.post');
        Route::get('/admin/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');
        Route::post('/admin/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');
        Route::get('/admin/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');
    });

    // Admin Reviw All Route 
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/pending/review', 'PendingReview')->name('pending.review');
        Route::get('/review/approve/{id}', 'ReviewApprove')->name('review.approve');
        Route::get('/publish/review', 'PublishReview')->name('publish.review');
        Route::get('/review/delete/{id}', 'ReviewDelete')->name('review.delete');
    });

    // Site Setting All Route 
    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::post('/site/setting/update', 'SiteSettingUpdate')->name('site.setting.update');
        Route::get('/seo/setting', 'SeoSetting')->name('seo.setting');
        Route::post('/seo/setting/update', 'SeoSettingUpdate')->name('seo.setting.update');
    });

    // Permission All Route 
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
    });

    // Roles All Route 
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');
        // add role permission 
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}', 'AdminRolesEdit')->name('admin.edit.roles');
        Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}', 'AdminRolesDelete')->name('admin.delete.roles');
    });

    // Admin User All Route 
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/admin', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/admin/user/store', 'AdminUserStore')->name('admin.user.store');
        Route::get('/edit/admin/role/{id}', 'EditAdminRole')->name('edit.admin.role');
        Route::post('/admin/user/update/{id}', 'AdminUserUpdate')->name('admin.user.update');
        Route::get('/delete/admin/role/{id}', 'DeleteAdminRole')->name('delete.admin.role');
    });
}); // Admin End Middleware 


/// Frontend Product Details All Route 

// Route::get('/product/details/{slug}-{id}', [IndexController::class, 'ProductDetails']);
Route::get('/product/details/{slug}-{id}.html', [IndexController::class, 'ProductDetails'])
    ->where(['slug' => '([a-z\-]+)']);
Route::get('/product/category/{slug}-{id}.html', [IndexController::class, 'CatWiseProduct'])
    ->where(['slug' => '([a-z\-]+)']);
Route::get('/product/subcategory/{slug}-{id}.html', [IndexController::class, 'SubCatWiseProduct'])
    ->where(['slug' => '([a-z\-]+)']);

// Product View Modal With Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);




/// Frontend Reward Details All Route 
Route::get('/reward/details/{slug}-{id}.html', [IndexController::class, 'RewardDetails'])
    ->where(['slug' => '([a-z\-]+)']);




// Frontend Blog Post All Route 
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'AllBlog')->name('home.blog');
    Route::get('/post/details/{slug}-{id}', 'BlogDetails');
    Route::get('/post/category/{slug}-{id}', 'BlogPostCategory');
});


// Frontend Blog Post All Route 
Route::controller(ReviewController::class)->group(function () {
    Route::post('/store/review', 'StoreReview')->name('store.review');
});


// Search All Route 
Route::controller(IndexController::class)->group(function () {
    Route::post('/search', 'ProductSearch')->name('product.search');
    Route::post('/search-product', 'SearchProduct');
});

// Shop Page All Route 
Route::controller(ShopController::class)->group(function () {
    Route::get('/shop', 'ShopPage')->name('shop.page');
    Route::post('/shop/filter', 'ShopFilter')->name('shop.filter');
});

/// Add to Wishlist 
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);

/// Add to cart store data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini Cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

/// Add to cart store data For Product Details Page 
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);


/// User All Route
Route::middleware(['auth', 'role:user', 'verified'])->group(function () {
    // Cart All Route 
    Route::controller(CartController::class)->group(function () {
        Route::get('/mycart', 'MyCart')->name('mycart');
        Route::get('/get-cart-product', 'GetCartProduct');
        Route::get('/cart-remove/{rowId}', 'CartRemove');
        Route::get('/cart-decrement/{rowId}', 'CartDecrement');
        Route::get('/cart-increment/{rowId}', 'CartIncrement');
    });

    // Wishlist All Route 
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-product', 'GetWishlistProduct');
        Route::get('/wishlist-remove/{id}', 'WishlistRemove');
    });

    // Checkout All Route 
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/district-get/ajax/{province_id}', 'DistrictGetAjax');
        Route::get('/regency-get/ajax/{district_id}', 'RegencyGetAjax');
        Route::post('/checkout/store', 'CheckoutStore')->name('checkout.store');
    });

    

    // User Dashboard All Route 
    Route::controller(AllUserController::class)->group(function () {
        Route::get('/user/account/page', 'UserAccount')->name('user.account.page');
        Route::get('/user/profile/page', 'UserProfile')->name('user.profile.page');
        Route::get('/user/address/add', 'UserAddAddress')->name('user.address.add');
        Route::get('/user/address/editpage', 'UserEditAddress')->name('user.address.editpage');
        Route::get('/user/change/password', 'UserChangePassword')->name('user.change.password');
        Route::get('/user/order/page', 'UserOrderPage')->name('user.order.page');
        Route::get('/user/order_details/{order_id}', 'UserOrderDetails');
        Route::get('/user/invoice_download/{order_id}', 'UserOrderInvoice');
        Route::post('/return/order/{order_id}', 'ReturnOrder')->name('return.order');
        Route::get('/return/order/page', 'ReturnOrderPage')->name('return.order.page');

        // Order Tracking 
        Route::get('/user/track/order', 'UserTrackOrder')->name('user.track.order');
        Route::post('/order/tracking', 'OrderTracking')->name('order.tracking');
        Route::get('/user/myreward/page', 'UserMyRewardPage')->name('user.myreward.page');
        Route::get('/user/referral/page', 'UserReferralPage')->name('user.referral.page');
    });

    /// Frontend Coupon Option
    Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
    Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
    Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

    // Checkout Page Route 
    Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
}); // end group User middleware


Route::middleware(['guest'])->group(function () {
    Route::get('/guest/', [IndexGuestController::class, 'Index'])->name('home.guest');

    // Cart All Route 
    Route::controller(CartGuestController::class)->group(function () {
        Route::get('/guest/mycart', 'MyCart')->name('mycart.guest');
        Route::get('/guest/get-cart-product', 'GetCartProductGuest');
        Route::get('/guest/cart-remove/{rowId}', 'CartRemoveGuest');
        Route::get('/guest/cart-decrement/{rowId}', 'CartDecrementGuest');
        Route::get('/guest/cart-increment/{rowId}', 'CartIncrementGuest');
        Route::post('/guest/cart/data/store/{id}', 'AddToCart');
        Route::get('/guest/product/mini/cart', 'AddMiniCart');
        Route::get('/guest/minicart/product/remove/{rowId}', 'RemoveMiniCart');
        Route::post('/guest/dcart/data/store/{id}', 'AddToCartDetails');
        Route::post('/guest/coupon-apply', 'CouponApply');
        Route::get('/guest/coupon-calculation', 'CouponCalculation');
        Route::get('/guest/coupon-remove', 'CouponRemove');
    });

    // Checkout All Route 
    Route::controller(CheckoutGuestController::class)->group(function () {
        Route::get('/guest/district-get/ajax/{province_id}', 'DistrictGetAjax');
        Route::get('/guest/regency-get/ajax/{district_id}', 'RegencyGetAjax');
        Route::post('/guest/checkout/store', 'CheckoutStore')->name('checkout.store.guest');
    });
    
    // User Dashboard All Route 
    Route::controller(AllGuestController::class)->group(function () {
        // Order Tracking 
        Route::get('/guest/track/order', 'UserTrackOrder')->name('user.track.order.guest');
        Route::post('/guest/order/tracking', 'OrderTracking')->name('order.tracking.guest');
        Route::get('/guest/order_details/{order_id}', 'GuestOrderDetails');
        Route::get('/guest/invoice_download/{order_id}', 'GuestOrderInvoice');
    });

    // Checkout Page Route 
    Route::get('/guest/checkout', [CartGuestController::class, 'CheckoutCreate'])->name('checkout.guest');
    Route::get('/ninja/lokasi', [CartGuestController::class, 'getKabupaten'])->name('wilayah.kabupaten');

    // Search All Route 
    Route::controller(IndexGuestController::class)->group(function () {
        Route::post('/guest/search', 'ProductSearch')->name('product.search.guest');
        Route::post('/guest/search-product', 'SearchProduct');
    });

    // Shop Page All Route 
    Route::controller(ShopGuestController::class)->group(function () {
        Route::get('/guest/shop', 'ShopPage')->name('shop.page.guest');
        Route::post('/guest/shop/filter', 'ShopFilter')->name('shop.filter.guest');
    });

    Route::get('/guest/product/details/{slug}-{id}.html', [IndexGuestController::class, 'ProductDetails'])
        ->where(['slug' => '([a-z\-]+)']);
    Route::get('/guest/product/category/{slug}-{id}.html', [IndexGuestController::class, 'CatWiseProduct'])
        ->where(['slug' => '([a-z\-]+)']);
    Route::get('/guest/product/subcategory/{slug}-{id}.html', [IndexGuestController::class, 'SubCatWiseProduct'])
        ->where(['slug' => '([a-z\-]+)']);

    // Product View Modal With Ajax
    Route::get('/guest/product/view/modal/{id}', [IndexGuestController::class, 'ProductViewAjax']);
});

// Midtrans All Route 
Route::controller(MidtransController::class)->group(function () {
    Route::post('/midtrans/order', 'MidtransOrder')->name('midtrans.order');
    Route::post('/cash/order', 'CashOrder')->name('cash.order');
});

Route::get('/payment-success', [AllUserController::class, 'SuccessOrder'])->name('success.pay');
