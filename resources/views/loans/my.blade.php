@extends('layouts.app')

@section('content')
<h1>📚 Pinjaman Saya</h1>

<div class="card">

@if($loans->isEmpty())
    <p style="color:#666">Belum ada buku yang dipinjam.</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Denda</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loans as $loan)
        <tr>
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
        </tr>
        @endforeach
    </tbody>
</table>
@endif

</div>
@endsection
