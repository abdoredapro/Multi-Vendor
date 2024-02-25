<?php

use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\dashboard\RolesController;
use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\ImportProductController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


Route::group([
    
    'middleware'=> ['auth:admin', 'verified'],
    'as'=> 'dashboard.',
    'prefix' => 'admin/dashboard'

], function () {

    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/category/trash', [CategoryController::class, 'trash'])
    ->name('category.trash');

    Route::put('/category/{category}/restore', [CategoryController::class, 'restore'])
    ->name('category.restore');

    Route::delete('/category/{category}/force-delete', 
    [CategoryController::class, 'forceDelete'])
    ->name('category.force-delete');

    Route::get('products/import', [ImportProductController::class, 'index'])
    ->name('products.import');

    Route::post('products/import', [ImportProductController::class, 'store']);

    Route::resources([
        'category' => CategoryController::class,
        'products' => ProductController::class,
        'roles' => RolesController::class,
        'admins' => AdminController::class,
    ]);

});
