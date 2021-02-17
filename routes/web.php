<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\AdresseController;
use App\Http\Controllers\UserController;

// admin routes ->middleware('auth');
// ================== ADMIN ROUTES ==================

Route::group([

    'prefix'=>'manager', // na barra de endereços
    // 'as'    =>'manager.', // na rota das, adicionando 'manager.' na frente do name da rota
    'middleware' => ['auth:sanctum', 'verified']

], function () {

    //CATEGORIE
    Route::get('/categorie/create', [CategorieController::class,'create'])->name('create-categorie');
    Route::post('/categorie/store', [CategorieController::class,'store'])->name('save-categorie');
    Route::get('/categorie/list', [CategorieController::class,'index'])->name('list-categories');
    Route::get('/categorie/delete/{id}', [CategorieController::class,'destroy'])->name('delete-categories');

    //PRODUIT
    Route::get('/produits/create', [ProduitController::class,'create'])->name('create-produit');
    Route::post('/produit/store', [ProduitController::class,'store'])->name('save-produit');

    //USER
    Route::get('/user/list', [UserController::class, 'index'])->name('list-user');

});


// ================================= USER  ROUTES =================================

//ADRESSE
Route::get('/adresse/create', [AdresseController::class,'create'])->name('create-adresse');
Route::post('/adresse/store', [AdresseController::class,'store'])->name('save-adresse');

//PRODUIT
Route::get('/produits', [ProduitController::class, 'index'])->name('list-all');
Route::get('/produit/{id}/', [ProduitController::class,'show']);

//HOME
Route::get('/', [HomeController::class, 'welcome']);
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

//DASHBOARD
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
