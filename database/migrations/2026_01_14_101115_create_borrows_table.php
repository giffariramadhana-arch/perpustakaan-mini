<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('borrows', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('book_id')->constrained()->cascadeOnDelete();
        $table->date('borrow_date');
        $table->date('return_deadline');
        $table->date('returned_at')->nullable();
        $table->enum('status',['BORROWED','RETURNED'])->default('BORROWED');
        $table->integer('fine')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
