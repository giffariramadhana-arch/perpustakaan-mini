<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrow_date',
        'return_deadline',
        'return_date',
        'status',
    ];

    // Relasi ke buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // BONUS: hitung denda keterlambatan
   public function fine()
{
    if ($this->status === 'RETURNED' && $this->return_date) {

        $return   = Carbon::parse($this->return_date);
        $deadline = Carbon::parse($this->return_deadline);

        if ($return->gt($deadline)) { // jika terlambat
            $daysLate = $deadline->diffInDays($return);
            return $daysLate * 2000; // Rp 2.000 per hari
        }
    }

    return 0;
}
}
