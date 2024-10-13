<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournissurController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\CommendeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\GererUsersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//client
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/client', [ClientController::class, 'store']);
    Route::get('/clients', [ClientController::class, 'show_all']);
    Route::get('/client/{id}', [ClientController::class, 'show']);
    Route::post('/client/update/{id}', [ClientController::class, 'update']);
    Route::delete('/client/{id}', [ClientController::class, 'destroy']);
});

//fournissur
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/fournissur', [FournissurController::class, 'store']);
    Route::get('/fournissurs', [FournissurController::class, 'show_all']);
    Route::get('/fournissur/{id}', [FournissurController::class, 'show']);
    Route::post('/fournissur/update/{id}', [FournissurController::class, 'update']);
    Route::delete('/fournissur/{id}', [FournissurController::class, 'destroy']);
});

//categories
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/categori', [CategoryController::class, 'store']);
    Route::get('/categories', [CategoryController::class, 'show_all']);
    Route::get('/categori/{id}', [CategoryController::class, 'show']);
    Route::post('/categori/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/categori/{id}', [CategoryController::class, 'destroy']);
});

//product
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/products', [ProductController::class, 'show_all']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
});

//facture
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/facture', [FactureController::class, 'store']);
    Route::get('/factures', [FactureController::class, 'show_all']);
    Route::get('/facture/{id}', [FactureController::class, 'show']);
    Route::post('/facture/update/{id}', [FactureController::class, 'update']);
    Route::delete('/facture/{id}', [FactureController::class, 'destroy']);
});

//Commende
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/Commende', [CommendeController::class, 'store']);
    Route::get('/Commendes', [CommendeController::class, 'show_all']);
    Route::get('/Commende/{id}', [CommendeController::class, 'show']);
    Route::post('/Commende/update/{id}', [CommendeController::class, 'update']);
    Route::delete('/Commende/{id}', [CommendeController::class, 'destroy']);
});

//gere les Permission
Route::middleware("auth:sanctum")->group(function(){
    Route::post('/gererfournisseur/{id}', [PermissionController::class, 'GererFournisseur']);
    Route::post('/gererclient/{id}', [PermissionController::class, 'GererClient']);
    Route::post('/gererpermission/{id}', [PermissionController::class, 'GererPermission']);
    Route::post('/gererusrs/{id}', [PermissionController::class, 'GererUsrs']);
});

//gere les users
Route::middleware("auth:sanctum")->group(function(){
    Route::get('/users', [GererUsersController::class, 'show_all']);
    Route::get('/user/{id}', [GererUsersController::class, 'show']);
    Route::delete('/user/{id}', [GererUsersController::class, 'destroy']);
});
