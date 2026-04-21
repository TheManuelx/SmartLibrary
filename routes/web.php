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


//GENERAL
Route::get('/', function () { return view('welcome'); });
Route::get('login', function() { return view('users.login'); })->name('login');
Route::post('login', [UserController::class, 'loginValidate'])->name('validate');
Route::get('profile', function() { return view('users.profile'); })->name('profile');


//MAIN
Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');

//MENU
//MENU->Managebook
Route::get('managebooks', [UserController::class, 'manageBooks'])->name('managebooks');
//MENU->Borrowing
Route::get('borrowings/borroweditems', [UserController::class, 'manageBorrowings'])->name('borroweditems');
//Borrowing->Create & Store
Route::get('borrowings/create', [UserController::class, 'createBorrowing'])->name('borrowing.create');
Route::post('borrowings/store', [UserController::class, 'storeBorrowing'])->name('borrowing.manage');
//Borrowing->Update
Route::put('borrowings/return/{id}', [UserController::class, 'returnBook'])->name('return.book');
//Borrowing->Delete
Route::delete('borrowing/delete/{id}', [UserController::class, 'destroyBorrowing'])->name('borrowings.destroy');

//CRUD
//CRUD->Create
Route::get('books/create', [UserController::class, 'create'])->name('books.create');
Route::post('books/store', [UserController::class, 'store'])->name('books.store');
//CRUD->Read
Route::get('books/detail/{id}', [UserController::class, 'show'])->name('detail');
//CRUD->Update
Route::get('books/{id}/edit', [UserController::class, 'edit'])->name('edit');
Route::put('books/{id}', [UserController::class, 'update'])->name('update');
//CRUD->Delete
Route::delete('books/delete/{id}', [UserController::class, 'destroy'])->name('delete');

//NAVBAR
//NAVBAR->SearchBook
Route::get('searchbook', [UserController::class, 'searchBook'])->name('searchbook');
//NAVBAR->SearchCategory
Route::get('searchcategory', [UserController::class, 'searchCategory'])->name('searchcategory');
//NAVBAR->AddCategory
Route::post('books/addcategory', [UserController::class, 'addCategory'])->name('addcategory');

