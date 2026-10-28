@extends('layouts.bookspace')

@section('title', 'Tambah Buku - BookSpace')

@section('content')
    <div class="topbar">
        <div>
            <h1>Tambah Buku</h1>
            <div class="muted">Masukkan informasi buku baru.</div>
        </div>
        <a href="{{ route('books.index') }}" class="btn">Kembali</a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('books.store') }}">
            @include('books.form')

            <button type="submit" class="btn btn-gold">Simpan Buku</button>
            <a href="{{ route('books.index') }}" class="btn">Batal</a>
        </form>
    </div>
@endsection
