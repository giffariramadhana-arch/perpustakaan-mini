@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-center">Daftar Buku</h1>

{{-- Tombol Tambah Buku (hanya ADMIN) --}}
@auth
    @if(auth()->user()->role == 'admin')
        <div class="mb-4 text-right">
            <a href="{{ route('books.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                + Tambah Buku
            </a>
        </div>
    @endif
@endauth

<table class="min-w-full border border-gray-300 shadow-lg">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="px-4 py-3 border">Judul</th>
            <th class="px-4 py-3 border">Penulis</th>
            <th class="px-4 py-3 border">Tahun</th>
            <th class="px-4 py-3 border">Kategori</th>
            <th class="px-4 py-3 border">Stock</th>
            <th class="px-4 py-3 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr class="text-center border-b {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
            <td class="px-4 py-2 border">{{ $book->title }}</td>
            <td class="px-4 py-2 border">{{ $book->author }}</td>
            <td class="px-4 py-2 border">{{ $book->year }}</td>
            <td class="px-4 py-2 border">{{ $book->category }}</td>

            <td class="px-4 py-2 border">
                @if($book->stock > 0)
                    <span class="text-green-600 font-bold">{{ $book->stock }}</span>
                @else
                    <span class="text-red-600 font-bold">0</span>
                @endif
            </td>

            <td class="px-4 py-2 border">
                @auth
                    {{-- USER --}}
                    @if(auth()->user()->role == 'user')
                        @if($book->stock > 0)
                            <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                                @csrf
                                <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                    Pinjam
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400">Habis</span>
                        @endif

                    {{-- ADMIN --}}
                    @elseif(auth()->user()->role == 'admin')
                        <a href="{{ route('books.edit', $book->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <form action="{{ route('books.destroy', $book->id) }}" 
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                    onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>
                    @endif
                @else
                    {{-- GUEST --}}
                    <span class="text-gray-400 italic">Login untuk meminjam</span>
                @endauth
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
