<h2>Pengembalian Buku</h2>

<table border="1">
<tr>
    <th>User</th>
    <th>Buku</th>
    <th>Tanggal</th>
    <th>Aksi</th>
</tr>

@foreach($loans as $loan)
<tr>
    <td>{{ $loan->user->name }}</td>
    <td>{{ $loan->book->title }}</td>
    <td>{{ $loan->created_at->format('d-m-Y') }}</td>
    <td>
        <form method="POST" action="{{ route('loans.return', $loan->id) }}">
            @csrf
            @method('PUT')
            <button>Kembalikan</button>
        </form>
    </td>
</tr>
@endforeach
</table>
