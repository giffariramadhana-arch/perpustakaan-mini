<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    // USER PINJAM BUKU
    public function borrow(Book $book)
    {
        // stok habis
        if ($book->stock < 1) {
            return back()->with('error','Stok habis');
        }

        // maksimal 3 buku aktif
        $count = Loan::where('user_id', auth()->id())
                    ->where('status','BORROWED')
                    ->count();

        if ($count >= 3) {
            return back()->with('error','Maksimal 3 buku aktif');
        }

        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'return_deadline' => now()->addDays(7),
            'status' => 'BORROWED'
        ]);

        $book->decrement('stock');

        return back()->with('success','Buku berhasil dipinjam');
    }

    // USER - Pinjaman saya
    public function myLoans()
    {
        if(auth()->user()->role == 'admin'){
            return redirect()->route('admin.loans');
        }

        $loans = Loan::where('user_id', auth()->id())
                    ->with('book')
                    ->get();

        return view('loans.my', compact('loans'));
    }

    // ADMIN - Semua pinjaman + filter
    public function adminLoans(Request $request)
    {
        $query = Loan::with('book','user');

        if($request->status){
            $query->where('status',$request->status);
        }

        if($request->category){
            $query->whereHas('book', function($q) use ($request){
                $q->where('category',$request->category);
            });
        }

        if($request->keyword){
            $query->whereHas('book', function($q) use ($request){
                $q->where('title','like','%'.$request->keyword.'%');
            });
        }

        $loans = $query->get();
        return view('loans.admin', compact('loans'));
    }

    // RETURN
    public function returnBook(Loan $loan)
    {
        $loan->update([
            'status' => 'RETURNED',
            'return_date' => now()
        ]);

        $loan->book->increment('stock');

        return back();
    }

    // EXPORT CSV (rapi di Excel)
   public function exportCsv()
{
    try {
        $loans = Loan::with(['user','book'])->get();

        return response()->streamDownload(function () use ($loans) {
            $handle = fopen('php://output', 'w');

            // Header kolom
            fputcsv($handle, [
                'User',
                'Buku',
                'Tanggal Pinjam',
                'Deadline',
                'Tanggal Kembali',
                'Status',
                'Denda'
            ]);

            foreach ($loans as $loan) {
                fputcsv($handle, [
                    $loan->user->name ?? '',
                    $loan->book->title ?? '',
                    $loan->borrow_date,
                    $loan->return_deadline,
                    $loan->return_date,
                    $loan->status,
                    $loan->fine()
                ]);
            }

            fclose($handle);
        }, 'loans.csv');
    }
    catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine()
        ], 500);
    }
}
}
