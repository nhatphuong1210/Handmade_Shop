<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\BranchProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProducts;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;

//Frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::post('/tim-kiem', [HomeController::class, 'search']);

// Category, Brand homepage
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProducts::class, 'category_by_id']);
Route::get('/thuong-hieu-san-pham/{brand_id}', [BranchProduct::class, 'brand_by_id']);

// Product Detail
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'detail_product']);

// Backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'admin_layout']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin_dashboard', [AdminController::class, 'dashboard']);

// Category Product
Route::get('/add-category-product', [CategoryProducts::class, 'add_category_product']);
Route::get('/all-category-product', [CategoryProducts::class, 'all_category_product']);
Route::get('/edit-category-product/{categoryProduct_id}', [CategoryProducts::class, 'edit_category_product']);
Route::get('/delete-category-product/{categoryProduct_id}', [CategoryProducts::class, 'delete_category_product']);
Route::get('/unactive-category/{categoryProduct_id}', [CategoryProducts::class, 'unactive_category_product']);
Route::get('/active-category/{categoryProduct_id}', [CategoryProducts::class, 'active_category_product']);
Route::post('/save-category-product', [CategoryProducts::class, 'save_category_product']);
Route::post('/update-category-product/{categoryProduct_id}', [CategoryProducts::class, 'update_category_product']);

// Branch Product
Route::get('/add-branch-product', [BranchProduct::class, 'add_branch_product']);
Route::get('/all-branch-product', [BranchProduct::class, 'all_branch_product']);
Route::get('/edit-branch-product/{branchProduct_id}', [BranchProduct::class, 'edit_branch_product']);
Route::get('/delete-branch-product/{branchProduct_id}', [BranchProduct::class, 'delete_branch_product']);
Route::get('/unactive-branch/{branchProduct_id}', [BranchProduct::class, 'unactive_branch_product']);
Route::get('/active-branch/{branchProduct_id}', [BranchProduct::class, 'active_branch_product']);
Route::post('/save-branch-product', [BranchProduct::class, 'save_branch_product']);
Route::post('/update-branch-product/{branchProduct_id}', [BranchProduct::class, 'update_branch_product']);

// Product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

// Cart
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::get('/view-cart', [CartController::class, 'view_cart']);
Route::get('/gio-hang', [CartController::class, 'gio_hang']);
Route::get('/del-cart/{session_id}', [CartController::class, 'del_cart']);
Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_row_cart']);
Route::get('/delete-cart', [CartController::class, 'delete_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::post('/update-view-cart', [CartController::class, 'update_cart_quanlity']);

// Coupon
Route::get('/unset-coupon', [CouponController::class, 'unset_coupon']);
Route::get('/add-coupon', [CouponController::class, 'add_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);
Route::get('/all-coupon', [CouponController::class, 'all_coupon']);
Route::post('/check-coupon', [CartController::class, 'check_coupon']);
Route::post('/save-coupon', [CouponController::class, 'save_coupon']);

// Login Checkout
Route::get('/delete-fee-home', [CheckoutController::class, 'delete_fee_home']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/login', [CheckoutController::class, 'login_customer']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::post('/calculate-fee', [CheckoutController::class, 'calculate_fee']);
Route::post('/get-delivery-home', [CheckoutController::class, 'get_delivery_home']);
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);

// Order
 Route::get('print-order/{checkout_code}', [OrderController::class, 'print_order'])->name('print_order');
Route::post('/save-order', [CheckoutController::class, 'save_order']);
Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/view-order-detail/{order_id}', [CheckoutController::class, 'view_order_detail']);
Route::get('/delete-order/{order_id}', [CheckoutController::class, 'delete_order']);
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');

// Send mail
Route::get('/contact', [HomeController::class, 'contact']);
Route::post('/send-mail', [HomeController::class, 'send_mail']);

// Login Facebook
Route::get('/login-fb', [AdminController::class, 'login_facebook']);
Route::get('/admin/callback', [AdminController::class, 'callback_facebook']);

// Login Google
Route::get('/login-google', [AdminController::class, 'login_google']);
Route::get('/google/callback', [AdminController::class, 'callback_google']);

// Delivery
Route::post('/get-delivery', [DeliveryController::class, 'get_delivery']);
Route::post('/add-feeship', [DeliveryController::class, 'add_feeship']);
Route::post('/fetch-feeship', [DeliveryController::class, 'fetch_feeship']);
Route::post('/update-feeship', [DeliveryController::class, 'update_feeship']);
// Route để hiển thị form thêm giá vận chuyển
Route::get('/add-delivery', [DeliveryController::class, 'addDelivery'])->name('add.delivery');
// Route để hiển thị danh sách giá vận chuyển
Route::get('/all-delivery', [DeliveryController::class, 'allDelivery'])->name('all.delivery');
// Route xử lý lưu giá vận chuyển
Route::post('/save-delivery', [DeliveryController::class, 'saveDelivery'])->name('save.delivery');
// Route xóa giá vận chuyển
Route::get('/delete-delivery/{id}', [DeliveryController::class, 'deleteDelivery'])->name('delete.delivery');
Route::get('/edit-delivery/{id}', [DeliveryController::class, 'editDelivery'])->name('edit.delivery');
Route::put('/update-delivery/{id}', [DeliveryController::class, 'updateDelivery'])->name('update.delivery');

//Email
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');

// Mess
Route::post('/send-mail', [ContactController::class, 'sendMail'])->name('contact.send');
Route::get('/adminmessages', [ContactController::class, 'showMessages'])->name('admin.messages');
Route::get('/all-messages', [ContactController::class, 'allMessages'])->name('all.messages');
Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order']);