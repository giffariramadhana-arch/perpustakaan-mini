<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // tampilkan semua buku
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // form tambah buku
    public function create()
    {
        return view('books.create');
    }

    // simpan buku
    public function store(Request $request)
    {
        Book::create($request->all());
        return redirect()->route('books.index');
    }

    // form edit
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // update buku
    public function update(Request $request, Book $book)
    {
        $book->update($request->all());
        return redirect()->route('books.index');
    }

    // hapus buku
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
