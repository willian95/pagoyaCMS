<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HeaderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware("guest");

Route::post("login", [AuthController::class, "login"]);
Route::get("logout", [AuthController::class, "logout"])->name("logout");

Route::get('/home', function () {
    return view('dashboard');
})->middleware("auth");

Route::view("categories", "categories.index")->name("categories.index");
Route::post("categories/store", [CategoryController::class, "store"])->name("categories.store");
Route::get("categories/fetch", [CategoryController::class, "fetch"])->name("categories.fetch");
Route::post("categories/update", [CategoryController::class, "update"])->name("categories.update");
Route::post("categories/delete", [CategoryController::class, "delete"])->name("categories.delete");

Route::view("docs/create", "docs.create.index")->name("docs.create");
Route::view("docs/list", "docs.list.index")->name("docs.list");
Route::post("docs/store", [DocController::class, "store"])->name("docs.store");
Route::post("docs/update", [DocController::class, "update"])->name("docs.update");
Route::get("docs/fetch", [DocController::class, "fetch"])->name("docs.fetch");
Route::get("docs/edit/{id}", [DocController::class, "edit"])->name("docs.edit");

Route::get("headers", function(){


    return view("headers.index");

})->name("header.index");

Route::post("header/update", [HeaderController::class, "store"]);
Route::post("upload/picture", [FileController::class, "upload"]);