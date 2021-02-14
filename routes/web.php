<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\HomeController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

// ================== HOME ROUTES ==================
//Display all products at home page
//Route::get('/', [HomeController::class, 'index']);


// ================== PRODUIT ROUTES ==================

// //Display all products at home page
// https://laravel.com/docs/8.x/routing#named-routes {{ route('produits/crete') }}
 Route::get('/produits', [ProduitController::class, 'index'])->name('produits');

//Show form to create a new product. Le ->middleware('auth') :only connected users have access
Route::get('/produits/create', [ProduitController::class,'create']);

 /*Show details about an product*/
//Route::get('/produit/{id}', [ProduitController::class,'show']);

// //Send form(create product) for method store at the controller.
//Route::post('/produit', [ProduitController::class,'store']);

// // ================== DASHBOARD ROUTES  ==================

// //->middleware('auth'): only connected users have access
// Route::get('/dashboard', [AdminController::class,'dashboard'])->middleware('auth');






