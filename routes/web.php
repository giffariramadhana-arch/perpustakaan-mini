<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome'); // tampilan halaman utama untuk guest
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect('/books');
    }
    return redirect('/books');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Books (PUBLIC)
|--------------------------------------------------------------------------
*/
// SEMUA orang boleh lihat daftar buku
Route::get('/books', [BookController::class, 'index'])->name('books.index');


/*
|--------------------------------------------------------------------------
| Books (ADMIN ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','admin'])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});

// USER meminjam buku
Route::middleware('auth')->post('/borrow/{book}', [LoanController::class, 'borrow'])
    ->name('books.borrow');

// USER lihat pinjaman
Route::middleware('auth')->get('/my-loans', [LoanController::class, 'myLoans'])
    ->name('loans.my');

// ADMIN mengembalikan buku
Route::middleware(['auth','admin'])->put('/return/{loan}', [LoanController::class, 'returnBook'])
    ->name('loans.return');

// ADMIN lihat semua pinjaman
Route::middleware(['auth','admin'])->get('/admin/loans', [LoanController::class, 'adminLoans'])
    ->name('admin.loans');

Route::middleware(['auth','admin'])->get('/admin/loans/export', [LoanController::class, 'exportCsv'])
    ->name('admin.loans.export');


/*
|--------------------------------------------------------------------------
| Auth Routes (WAJIB)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
