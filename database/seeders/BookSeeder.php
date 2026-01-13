<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Pemrograman Laravel',
                'author' => 'John Doe',
                'year' => 2023,
                'stock' => 5,
                'category' => 'Programming',
            ],
            [
                'title' => 'Algoritma & Struktur Data',
                'author' => 'Jane Smith',
                'year' => 2022,
                'stock' => 3,
                'category' => 'Programming',
            ],
            [
                'title' => 'Basis Data MySQL',
                'author' => 'Alice Brown',
                'year' => 2021,
                'stock' => 4,
                'category' => 'Database',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
