<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProblemController;
use App\Http\Controllers\Admin\{
    AttributeController,
    AttributeValueController,
    BrandController,
    CategoryController,
    CategoryChildrenController,
    DashboardController,
    HelpCenterCategoryController,
    HelpCenterController,
    LenderController,
    LoginController,
    MenuController,
    OrderController,
    PageController,
    ProductController,
    ProductImageController,
    RenterController,
    SettingController,
    TagController,
    UserController,
    SupportController,
};
Route::get('login', [LoginController::class, 'loginForm'])->name('login.form');

Route::middleware('admin')->group(function (){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard.index');
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('pages/{page}/edit-blocks', [PageController::class, 'editBlocks'])->name('pages.edit-blocks');
    Route::put('pages/{page}/update-blocks', [PageController::class, 'updateBlocks'])->name('pages.update-blocks');
    Route::resource('pages', PageController::class)->except('show');
    Route::resource('tags', TagController::class)->except(['show']);
    Route::get('product-image/{image}/remove',[ProductImageController::class,'remove'])->name('product.image-remove');
    Route::get('products-renters/{product}', [ProductController::class,'renterList'])->name('product.renter-list');
    Route::resource('help-center-category', HelpCenterCategoryController::class)->except(['show']);
    Route::resource('help-center', HelpCenterController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show','create','store']);
    Route::resource('attributes.values',AttributeValueController::class)->except(['show']);
    Route::resource('attributes',AttributeController::class)->except(['show']);
    Route::resource('brands',BrandController::class)->except(['show']);
    Route::resource('categories',CategoryController::class)->except(['show']);
    Route::resource('categories.children',CategoryChildrenController::class)->except(['show']);
    Route::resource('lenders',LenderController::class)->except(['show','store','create']);
    Route::resource('supports',SupportController::class);
    Route::resource('problems',ProblemController::class);
    Route::resource('renters',RenterController::class)->except(['show','store','create']);
    Route::resource('orders',OrderController::class)->only(['index','show','update']);

    Route::prefix('menu')->as('menus.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index');
        Route::get('/edit/{menu}', [MenuController::class, 'edit'])->name('edit');
        Route::post('/store', [MenuController::class, 'store'])->name('store');
        Route::post('/get-sortable', [MenuController::class, 'get_sortable'])->name('get-sortable');
        Route::post('/save-sortable', [MenuController::class, 'save_sortable'])->name('save-sortable');
        Route::post('/destroy', [MenuController::class, 'destroy'])->name('destroy');
    });



    Route::name('user.')->prefix('/user/')->group(function (){
        Route::patch('/update/{user}',[UserController::class,'update'])->name('update');
        Route::put('/update-status/{user}',[UserController::class,'updateStatus'])->name('update-status');
    });


});


