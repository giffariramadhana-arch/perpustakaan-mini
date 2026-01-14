<h2 class="text-2xl font-bold mb-4">Tambah Buku</h2>

<form method="POST" action="{{ route('books.store') }}">
@csrf

<input name="title" placeholder="Judul" class="border p-2 w-full mb-2" required>
<input name="author" placeholder="Penulis" class="border p-2 w-full mb-2" required>
<input name="year" placeholder="Tahun" class="border p-2 w-full mb-2" required>
<input name="stock" type="number" placeholder="Stok" class="border p-2 w-full mb-2" required>

<select name="category" class="border p-2 w-full mb-4" required>
    <option value="">-- Pilih Kategori --</option>
    <option value="Novel">Novel</option>
    <option value="Pendidikan">Pendidikan</option>
    <option value="Teknologi">Teknologi</option>
    <option value="Agama">Agama</option>
    <option value="Sejarah">Sejarah</option>
</select>

<button class="bg-blue-600 text-white px-4 py-2 rounded">
    Simpan
</button>

</form>
