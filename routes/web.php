<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Show product list
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Update product size
Route::post('/products/update-size', [ProductController::class, 'updateSize']);

// Create product
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products', [ProductController::class, 'store'])->name('products.store');  

// Edit product
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

// Delete product
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');