@csrf

<label>
    Judul Buku
    <input type="text" name="judul" value="{{ old('judul', $book->judul ?? '') }}" required>
    @error('judul') <div class="error">{{ $message }}</div> @enderror
</label>

<label>
    Penulis
    <input type="text" name="penulis" value="{{ old('penulis', $book->penulis ?? '') }}" required>
    @error('penulis') <div class="error">{{ $message }}</div> @enderror
</label>

<label>
    Kategori
    <input type="text" name="kategori" value="{{ old('kategori', $book->kategori ?? '') }}" required>
    @error('kategori') <div class="error">{{ $message }}</div> @enderror
</label>

<label>
    Tahun Terbit
    <input type="number" name="tahun_terbit"
        value="{{ old('tahun_terbit', $book->tahun_terbit ?? '') }}"
        min="1000" max="2100" required>
    @error('tahun_terbit') <div class="error">{{ $message }}</div> @enderror
</label>

<label>
    Deskripsi
    <textarea name="deskripsi" rows="4">{{ old('deskripsi', $book->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <div class="error">{{ $message }}</div> @enderror
</label>
