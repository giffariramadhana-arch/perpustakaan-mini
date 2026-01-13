<h2>Tambah Buku</h2>

<form method="POST" action="{{ route('books.store') }}">
@csrf
<input name="title" placeholder="Judul"><br>
<input name="author" placeholder="Penulis"><br>
<input name="year" placeholder="Tahun"><br>
<input name="stock" placeholder="Stok"><br>
<input name="category" placeholder="Kategori"><br>
<button>Simpan</button>
</form>
