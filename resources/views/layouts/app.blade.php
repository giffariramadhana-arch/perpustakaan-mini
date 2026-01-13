<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan Mini</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<nav style="background:#2c3e50;padding:15px;">
    <div style="max-width:1100px;margin:auto;display:flex;justify-content:space-between;align-items:center;">
        <div>
            <span style="color:white;font-size:18px;font-weight:bold;">
                📚 Perpustakaan Mini
            </span>
        </div>

        <div>
            {{-- Jika belum login --}}
            @guest
                <a href="{{ route('login') }}" class="btn btn-blue">Login</a>
                <a href="{{ route('register') }}" class="btn btn-green">Register</a>
            @endguest

            {{-- Jika sudah login --}}
            @auth
                <a href="{{ route('books.index') }}" class="btn btn-blue">Daftar Buku</a>

                @if(auth()->user()->role == 'user')
                    <a href="{{ route('loans.my') }}" class="btn btn-green">Pinjaman Saya</a>
                @elseif(auth()->user()->role == 'admin')
                    <a href="{{ route('admin.loans') }}" class="btn btn-green">Semua Pinjaman</a>
                @endif

                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-red">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>