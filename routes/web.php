<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\AdresseController;



/** admin routes */
// ================== ADMIN ROUTES ==================

Route::group([

    'prefix'=>'manager', // na barra de endereços
    // 'as'    =>'manager.', // na rota das, adicionando 'manager.' na frente do name da rota
    'middleware' => ['auth:sanctum', 'verified']

], function () {
    Route::get('/categorie/create', [CategorieController::class,'create'])->name('create-categorie');
    Route::post('/categorie/store', [CategorieController::class,'store'])->name('save-categorie');

    //Show form to create a new product. Le ->middleware('auth') :only connected users have access
    Route::get('/produits/create', [ProduitController::class,'create'])->name('create-produit');

    //Send form(create product)
    Route::post('/produit/store', [ProduitController::class,'store'])->name('save-produit');
});
//->middleware('auth');
// ================== USER  ROUTES ==================

//ADRESSE
Route::get('/adresse/create', [AdresseController::class,'create'])->name('create-adresse');
Route::post('/adresse/store', [AdresseController::class,'store'])->name('save-adresse');

//PRODUIT
// //Display all products at home page
 Route::get('/produits', [ProduitController::class, 'index'])->name('list-all');
//Show details about a product
Route::get('/produit/{id}/', [ProduitController::class,'show']);

//HOME
// Show home page
Route::get('/', [HomeController::class, 'welcome']);

//Show contact page
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

 // ================== DASHBOARD ROUTES  ==================

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');











// Route::get('/contact', function () {
//     return view('contact');
// });

// Detran Routes
// Route::group([
//     'prefix' => 'detran',
// ], function () {
//     // GET: /detran
//     Route::get('/', [
//         'as'   => 'detrans',
//         'uses' => 'DetranController@index',
//     ]);

//     // GET: /detran/{detran}
//     Route::get('/{detran}', [
//         'as'   => 'detran',
//         'uses' => 'DetranController@show',
//     ]);
// });

/**
 * Authenticated Routes.
 */
// Route::group([
//     'as'         => 'auth.',
//     'middleware' => ['auth'],
// ], function () {
//     // GET: /escolher-perfil
//     Route::get('/escolher-perfil', [
//         'as'         => 'chooseProfileForm',
//         'uses'       => 'UsersController@chooseProfileForm',
//         'middleware' => 'doNotCacheResponse',
//     ]);
// });
