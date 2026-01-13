<h2>Edit Buku</h2>

<form method="POST" action="{{ route('books.update', $book->id) }}">
@csrf
@method('PUT')

<input name="title" value="{{ $book->title }}"><br>
<input name="author" value="{{ $book->author }}"><br>
<input name="year" value="{{ $book->year }}"><br>
<input name="stock" value="{{ $book->stock }}"><br>
<input name="category" value="{{ $book->category }}"><br>

<button>Update</button>
</form>
