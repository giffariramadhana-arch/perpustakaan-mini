@extends('layouts.app')

@section('content')
<h1>📊 Semua Transaksi Peminjaman</h1>

<div class="card">

<form method="GET" class="filter-bar">
    <div>
        <label>Status</label>
        <select name="status">
            <option value="">Semua</option>
            <option value="BORROWED" {{ request('status')=='BORROWED' ? 'selected' : '' }}>BORROWED</option>
            <option value="RETURNED" {{ request('status')=='RETURNED' ? 'selected' : '' }}>RETURNED</option>
        </select>
    </div>

    <div>
        <label>Kategori</label>
        <input type="text" name="category" value="{{ request('category') }}">
    </div>

    <div>
        <label>Judul Buku</label>
        <input type="text" name="keyword" value="{{ request('keyword') }}">
    </div>

    <div>
        <button class="btn btn-blue">Filter</button>
        <a href="{{ route('admin.loans.export') }}" class="btn btn-green">⬇ Export CSV</a>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th>User</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Denda</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loans as $loan)
        <tr>
            <td>{{ $loan->user->name }}</td>
            <td>{{ $loan->book->title }}</td>
            <td>{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($loan->return_deadline)->format('d-m-Y') }}</td>

            <td>
                @if($loan->status == 'BORROWED')
                    <span class="badge badge-warning">BORROWED</span>
                @else
                    <span class="badge badge-success">RETURNED</span>
                @endif
            </td>

            <td>
                Rp {{ number_format($loan->fine(),0,',','.') }}
            </td>

            <td>
                @if($loan->status == 'BORROWED')
                <form action="{{ route('loans.return',$loan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-red">Kembalikan</button>
                </form>
                @else
                    <span style="color:#999">Selesai</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
