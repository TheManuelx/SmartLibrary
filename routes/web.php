<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


//General
Route::get('/', function () { return view('welcome'); });
Route::get('login', function() { return view('users.login'); })->name('login');
Route::post('login', [UserController::class, 'loginValidate'])->name('validate');
Route::get('profile', function() { return view('users.profile'); })->name('profile');


//Book Management
//Main
Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');

//Menu
Route::get('managebooks', [UserController::class, 'manageBooks'])->name('managebooks');
Route::get('managecategories', function(){ return view('users.managecategories'); })->name('managecategories');
Route::get('borroweditems', function(){ return view('users.borroweditems'); })->name('borroweditems');

//CRUD
//Create
Route::get('books/create', [UserController::class, 'create'])->name('books.create');
Route::post('books/store', [UserController::class, 'store'])->name('books.store');

//Read
Route::get('books/detail/{id}', [UserController::class, 'show'])->name('detail');

//Update
Route::get('books/{id}/edit', [UserController::class, 'edit'])->name('edit');
Route::put('books/{id}', [UserController::class, 'update'])->name('update');

//Delete
Route::delete('books/delete/{id}', [UserController::class, 'destroy'])->name('delete');

//Navbar
//SearchBook
Route::get('searchbook', [UserController::class, 'searchBook'])->name('searchbook');
//SearchCategory
Route::get('searchcategory', [UserController::class, 'searchCategory'])->name('searchcategory');