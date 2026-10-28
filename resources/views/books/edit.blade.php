@extends('layouts.bookspace')

@section('title', 'Edit Buku - BookSpace')

@section('content')
    <div class="topbar">
        <div>
            <h1>Edit Buku</h1>
            <div class="muted">Perbarui informasi buku yang dipilih.</div>
        </div>
        <a href="{{ route('books.index') }}" class="btn">Kembali</a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('books.update', $book) }}">
            @method('PUT')
            @include('books.form', ['book' => $book])

            <button type="submit" class="btn btn-gold">Simpan Perubahan</button>
            <a href="{{ route('books.index') }}" class="btn">Batal</a>
        </form>
    </div>
@endsection
