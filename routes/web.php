<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategorieController;


// ================== HOME ROUTES ==================

// Show home page
Route::get('/', [HomeController::class, 'welcome']);
//Show contact page
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


// ================== CATEGORIE ROUTES ==================

Route::get('/categorie/create', [CategorieController::class,'create'])->name('create-categorie');
Route::post('/categorie/store', [CategorieController::class,'store'])->name('save-categorie');



// ================== PRODUIT ROUTES ==================

// //Display all products at home page
 Route::get('/produits', [ProduitController::class, 'index'])->name('list-all');

//Show form to create a new product. Le ->middleware('auth') :only connected users have access
Route::get('/produits/create', [ProduitController::class,'create'])->name('create-produit');

//Show details about a product
Route::get('/produit/{id}', [ProduitController::class,'show']);

//Send form(create product)
Route::post('/produit/store', [ProduitController::class,'store'])->name('save-produit');


 // ================== DASHBOARD ROUTES  ==================

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');




