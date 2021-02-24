<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\AdresseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;

// admin routes ->middleware('auth');
// ================================= ADMIN ROUTES =================================
// Donne acces seulement à ceux qui sont connectés
Route::group([

    'prefix'=>'admin', // na barra de endereços
    // 'as'    =>'manager.', // na rota das, adicionando 'manager.' na frente do name da rota
    'middleware' => ['auth:sanctum', 'verified']

], function () {

    //CATEGORIE
    Route::get('/categorie/create', [CategorieController::class,'create'])->name('create-categorie');
    Route::post('/categorie/store', [CategorieController::class,'store'])->name('save-categorie');
    Route::get('/categorie/list', [CategorieController::class,'index'])->name('list-categories');
    Route::get('/categorie/edit/{id}', [CategorieController::class,'edit'])->name('edit-categorie');
    Route::put('/categorie/update/{id}', [CategorieController::class,'update'])->name('update-categorie');

    //PRODUIT
    Route::get('/produits/create', [ProduitController::class,'create'])->name('create-produit');
    Route::post('/produit/store', [ProduitController::class,'store'])->name('store-produit');
    Route::get('/produit/list', [ProduitController::class,'list'])->name('list-produit');
    Route::get('/produit/edit/{id}', [ProduitController::class,'edit'])->name('edit-produit');
    Route::put('/produit/update/{id}', [ProduitController::class,'update'])->name('update-produit');
    Route::get('/produit/destroy/{id}', [ProduitController::class,'destroy'])->name('destroy-produit');

    //USER
    Route::get('/user/list', [UserController::class, 'index'])->name('list-user');
});

// ================================= USER  ROUTES =================================

//ADRESSE
Route::get('/adresse/create', [AdresseController::class,'create'])->name('create-adresse');
Route::post('/adresse/show', [AdresseController::class,'store'])->name('save-adresse');
Route::get('/adresse/show/{id}/', [AdresseController::class,'show'])->name('show-adresse');
Route::get('/adresse/list/', [AdresseController::class,'list'])->name('list-adresse');
Route::put('/adresse/update/{id}', [AdresseController::class,'update'])->name('update-adresse');
Route::get('/adresse/edit/{id}', [AdresseController::class,'edit'])->name('edit-adresse');
Route::get('/adresse/destroy/{id}', [AdresseController::class,'destroy'])->name('destroy-adresse');

//PRODUIT
Route::get('/produits', [ProduitController::class, 'index'])->name('list-all');
Route::get('/produit/{id}/', [ProduitController::class,'show']);

//HOME
Route::get('/', [HomeController::class, 'welcome']);
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

//CART
Route::post('/cart/store', [CartController::class,'store'])->name('store-cart')->middleware('auth');
Route::get('/cart/destroy', [CartController::class,'destroy'])->name('destroy-cart');
Route::get('/cart/list', [CartController::class,'list'])->name('list-cart');
Route::get('/cart/add/{id}/', [CartController::class,'addQuantity'])->name('add-cart');
Route::get('/cart/remove/{id}/', [CartController::class,'removeQuantity'])->name('remove-cart');
Route::get('/cart/remove-item/{id}/', [CartController::class,'removeItem'])->name('remove-item-cart');

// =====================================================================================

//DASHBOARD
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::get('/dashboard', [HomeController::class, 'welcome'])->name('welcome');

// Route::get('/contact', function () {
//     return view('contact');
// });
