<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WhatsappPhoneController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ProspectController;

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
Route::post("docs/delete", [DocController::class, "delete"])->name("docs.delete");
Route::get("docs/fetch", [DocController::class, "fetch"])->name("docs.fetch");
Route::get("docs/edit/{id}", [DocController::class, "edit"])->name("docs.edit");

Route::get("headers", function(){


    return view("headers.index");

})->name("header.index");

Route::post("header/update", [HeaderController::class, "store"]);
Route::post("upload/picture", [FileController::class, "upload"]);

Route::view("blogs/create", "blogs.create.index")->name("blogs.create");
Route::view("blogs/list", "blogs.list.index")->name("blogs.list");
Route::post("blogs/store", [BlogController::class, "store"])->name("blogs.store");
Route::post("blogs/update", [BlogController::class, "update"])->name("blogs.update");
Route::post("blogs/delete", [BlogController::class, "delete"])->name("blogs.delete");
Route::get("blogs/fetch", [BlogController::class, "fetch"])->name("blogs.fetch");
Route::get("blogs/edit/{id}", [BlogController::class, "edit"]);

Route::view("whatsapp/index", "whatsapp.index")->name("whatsapp.index");
Route::post("/whatsapp/update", [WhatsappPhoneController::class, "update"])->name("whatsapp.update");

Route::post("/ckeditor/upload", [CKEditorController::class, "upload"])->name("ckeditor.upload");

Route::view("prospects", "prospects.index")->name("prospects.index");
Route::get("prospects/fetch", [ProspectController::class, "fetch"])->name("prospects.fetch");

Route::view("registered", "registered.index")->name("registered.index");
Route::get("registered/fetch", [RegisteredUserController::class, "fetch"])->name("registered.fetch");