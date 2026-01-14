<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('books.create');
    }

    // Menyimpan buku baru ke database
   public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'year' => 'required',
        'stock' => 'required|integer',
        'category' => 'required'
    ]);

    Book::create([
        'title' => $request->title,
        'author' => $request->author,
        'year' => $request->year,
        'stock' => $request->stock,
        'category' => $request->category,
    ]);

    return redirect()->route('books.index')
        ->with('success', 'Buku berhasil ditambahkan');
}

    // Menampilkan form edit buku
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Memperbarui data buku
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'author'    => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year'      => 'required|integer',
            'stock'     => 'required|integer|min:0',
        ]);

        $book->update($request->only([
            'title',
            'author',
            'publisher',
            'year',
            'stock'
        ]));

        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil diperbarui');
    }

    // Menghapus buku
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
                         ->with('success', 'Buku berhasil dihapus');
    }
}