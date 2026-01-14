<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;

class BorrowController extends Controller
{
    public function store(Request $request)
    {
        $book = Book::findOrFail($request->book_id);

        // 1️⃣ Cek stok
        if ($book->stock == 0) {
            return back()->with('error', 'Stock buku habis.');
        }

        // 2️⃣ Cek jumlah buku aktif user
        $active = Borrow::where('user_id', auth()->id())
            ->where('status', 'BORROWED')
            ->count();

        if ($active >= 3) {
            return back()->with('error', 'Anda tidak bisa meminjam lebih dari 3 buku.');
        }

        // 3️⃣ Simpan transaksi peminjaman
        Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'return_deadline' => now()->addDays(7),
            'status' => 'BORROWED'
        ]);

        // 4️⃣ Kurangi stok
        $book->decrement('stock');

        return back()->with('success', 'Buku berhasil dipinjam.');
    }
}