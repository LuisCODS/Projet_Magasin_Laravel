<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\HomeController;


// ================== HOME ROUTES ==================

// home page
Route::get('/', [HomeController::class, 'welcome']);
//Shou contact page
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


// ================== PRODUIT ROUTES ==================

// //Display all products at home page
 Route::get('/produits', [ProduitController::class, 'index'])->name('list-all');

//Show form to create a new product. Le ->middleware('auth') :only connected users have access
Route::get('/produits/create', [ProduitController::class,'create'])->name('create-produit');

//Show details about an product
Route::get('/produit/{id}', [ProduitController::class,'show']);

//Send form(create product)
Route::post('/produit/store', [ProduitController::class,'store'])->name('save-produit');

// // ================== DASHBOARD ROUTES  ==================

// //->middleware('auth'): only connected users have access
// Route::get('/dashboard', [AdminController::class,'dashboard'])->middleware('auth');




