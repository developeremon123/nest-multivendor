<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Vendor\VendorController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\SubCategoryController;
use App\Http\Controllers\Backend\Vendor\VendorProductController;

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

Route::get('/', function () {
    return view('frontend.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/user/profile', [UserController::class, 'update'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::post('/change-password',[UserController::class,'UserPasswordUpdate'])->name('user.update.password');
});

//Admin Dashboard
Route::prefix('/admin')->as('admin.')->middleware(['auth','role:admin'])->group(function(){
    Route::get('/dashboard',[AdminController::class,'AdminDashboard'])->name('dashboard');
    Route::get('/logout',[AdminController::class,'destroy'])->name('logout');
    Route::get('/profile',[AdminController::class,'adminProfile'])->name('profile');
    Route::post('/profile',[AdminController::class,'adminProfileStore'])->name('profile.store');
    Route::get('/change-password',[AdminController::class,'adminChangePassword'])->name('change.password');
    Route::post('/change-password',[AdminController::class,'adminPasswordUpdate'])->name('update.password');
    // Brand Routes
    Route::get('/all-brand', [BrandController::class, 'allBrands'])->name('all.brands');
    Route::get('/add-brand', [BrandController::class, 'addBrand'])->name('add.brand');
    Route::post('/store-brand', [BrandController::class, 'brandStore'])->name('brand.store');
    Route::get('/edit-brand/{id}', [BrandController::class, 'editBrand'])->name('edit.brand');
    Route::post('/update-brand/{id}', [BrandController::class, 'updateBrand'])->name('update.brand');
    Route::get('/delete-brand/{id}', [BrandController::class, 'deleteBrand'])->name('delete.brand');
    // Category Routes
    Route::get('/all-category', [CategoryController::class, 'allCategory'])->name('all.categories');
    Route::get('/add-category', [CategoryController::class, 'addCategory'])->name('add.category');
    Route::post('/store-category', [CategoryController::class, 'categoryStore'])->name('category.store');
    Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');
    Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');
    Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');
    // Product Routes
    Route::get('/all-product', [ProductController::class, 'allProducts'])->name('all.products');
    Route::get('/add-product', [ProductController::class, 'addProduct'])->name('add.product');
    Route::post('/store-product', [ProductController::class, 'storeProduct'])->name('product.store');
    Route::get('/edit-product/{id}', [ProductController::class, 'editProduct'])->name('edit.product');
    Route::post('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('update.product');
    Route::post('/update-product/thambnail/{id}', [ProductController::class, 'updateThambnail'])->name('update.thambnail');
    Route::get('/delete/product/multiple-image/{id}', [ProductController::class, 'deleteMultiImg'])->name('delete.multiimg');
    Route::get('/product/inactive/{id}', [ProductController::class, 'inactive'])->name('product.inactive');
    Route::get('/product/active/{id}', [ProductController::class, 'active'])->name('product.active');
    Route::get('/delete/product/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
    // SubCategory Routes
    Route::get('/all-subcategory', [SubCategoryController::class, 'allSubCategory'])->name('all.subcategories');
    Route::get('/add-subcategory', [SubCategoryController::class, 'addSubCategory'])->name('add.subcategory');
    Route::post('/store-subcategory', [SubCategoryController::class, 'subcategoryStore'])->name('subcategory.store');
    Route::get('/edit-subcategory/{id}', [SubCategoryController::class, 'editSubCategory'])->name('edit.subcategory');
    Route::post('/update-subcategory/{id}', [SubCategoryController::class, 'updateSubCategory'])->name('update.subcategory');
    Route::get('/delete-subcategory/{id}', [SubCategoryController::class, 'deleteSubCategory'])->name('delete.subcategory');
    Route::get('/subcategory-ajax/{category_id}', [SubCategoryController::class, 'getSubcategory'])->name('subcategory.ajax');
    // Vendor Active & Inactive Routes
    Route::get('/inactive-vendor', [AdminController::class, 'inactiveVendor'])->name('vendor.inactive');
    Route::get('/active-vendor', [AdminController::class, 'activeVendor'])->name('vendor.active');
    Route::get('/inactive-vendor/details/{id}', [AdminController::class, 'inactiveVendorDetails'])->name('inactive.vendorDetails');
    Route::get('/active-vendor/details/{id}', [AdminController::class, 'activeVendorDetails'])->name('active.vendorDetails');
    Route::post('/active-vendor/approve/{id}', [AdminController::class, 'activeVendorApprove'])->name('active.vendor.approve');
    Route::post('/inactive-vendor/approve/{id}', [AdminController::class, 'inactiveVendorApprove'])->name('inactive.vendor.approve');
});

//Vendor Dashboard
Route::prefix('/vendor')->as('vendor.')->middleware(['auth','role:vendor'])->group(function(){
    Route::get('/dashboard',[VendorController::class,'VendorDashboard'])->name('dashboard');
    Route::get('/logout',[VendorController::class,'destroy'])->name('logout');
    Route::get('/profile',[VendorController::class,'vendorProfile'])->name('profile');
    Route::post('/profile',[VendorController::class,'vendorProfileStore'])->name('profile.store');
    Route::get('/change-password',[VendorController::class,'vendorChangePassword'])->name('change.password');
    Route::post('/change-password',[VendorController::class,'vendorPasswordUpdate'])->name('update.password');
    // Vendor Product routes
    Route::get('/product-list',[VendorProductController::class, 'vendorProductList'])->name('productList');
    Route::get('/add-product',[VendorProductController::class, 'vendorAddProduct'])->name('add.product');
    Route::get('/subcategory-ajax/{category_id}', [SubCategoryController::class, 'getSubcategory'])->name('subcategory.ajax');
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::post('/update-product/multiple-image', [ProductController::class, 'updateMultiImg'])->name('update.multi_img');
});

Route::get('/admin/login',[AdminController::class,'adminLogin'])->middleware('guest');
Route::get('/vendor/login',[VendorController::class,'vendorLogin'])->name('vendor.login')->middleware('guest');
Route::get('/become/vendor',[VendorController::class,'becomeVendor'])->name('become.vendor');
Route::post('/vendor/register',[VendorController::class,'vendorRegister'])->name('vendor.register');
require __DIR__.'/auth.php';
