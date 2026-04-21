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


//>>>===============================GENERAL==============================<
Route::get('/', function () { return view('welcome'); });
Route::get('login', function() { return view('users.login'); })->name('login');
Route::post('login', [UserController::class, 'loginValidate'])->name('validate');


//>>>==============================MAIN==============================<
Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');

//>>>==============================MENU==============================<
//>>>====================MANAGE BOOK====================<
Route::get('managebooks', [UserController::class, 'manageBooks'])->name('managebooks');
//>>>====================BORROWING====================<
Route::get('borrowings/borroweditems', [UserController::class, 'manageBorrowings'])->name('borroweditems');
//>>>====================CREATE AND STORE====================<
Route::get('borrowings/create', [UserController::class, 'createBorrowing'])->name('borrowing.create');
Route::post('borrowings/store', [UserController::class, 'storeBorrowing'])->name('borrowing.manage');
//>>>====================UPDATE====================<
Route::put('borrowings/return/{id}', [UserController::class, 'returnBook'])->name('return.book');
//>>>====================DELETE====================<
Route::delete('borrowing/delete/{id}', [UserController::class, 'destroyBorrowing'])->name('borrowings.destroy');

//>>>====================USER LIST====================<
Route::get('profile', [UserController::class, 'viewUser'])->name('users');
//>>>====================EDIT AND UPDATE====================<
Route::get('users/{id}/edituser', [UserController::class, 'editUser'])->name('user.edit');
Route::put('users/{id}', [UserController::class, 'updateUser'])->name('user.update');
//>>>====================DELETE====================<
Route::delete('users/delete/{id}', [UserController::class, 'deleteUser'])->name('user.delete');

//>>>==============================BOOK==============================<
//>>>====================CREATE====================<
Route::get('books/create', [UserController::class, 'create'])->name('books.create');
Route::post('books/store', [UserController::class, 'store'])->name('books.store');
//>>>====================READ====================<
Route::get('books/detail/{id}', [UserController::class, 'show'])->name('detail');
//>>>====================EDIT AND UPDATE====================<
Route::get('books/{id}/edit', [UserController::class, 'edit'])->name('edit');
Route::put('books/{id}', [UserController::class, 'update'])->name('update');
//>>>====================DELETE====================<
Route::delete('books/delete/{id}', [UserController::class, 'destroy'])->name('delete');

//>>>==============================NAVBAR==============================<
//>>>====================SEARCH BOOK====================<
Route::get('searchbook', [UserController::class, 'searchBook'])->name('searchbook');
//>>>====================SEARCH CATEGORY====================<
Route::get('searchcategory', [UserController::class, 'searchCategory'])->name('searchcategory');
//>>>====================ADD CATEGORY====================<
Route::post('books/addcategory', [UserController::class, 'addCategory'])->name('addcategory');

