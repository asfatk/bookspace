@extends('layouts.bookspace')

@section('title', 'Manajemen Buku - BookSpace')

@section('content')
    <div class="topbar">
        <div>
            <h1>Manajemen Buku</h1>
            <div class="muted">Kelola koleksi buku dalam satu tempat.</div>
        </div>

        @can('buku.create')
            <a href="{{ route('books.create') }}" class="btn btn-gold">+ Tambah Buku</a>
        @endcan
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $books->firstItem() + $loop->index }}</td>
                            <td><strong>{{ $book->judul }}</strong></td>
                            <td>{{ $book->penulis }}</td>
                            <td>{{ $book->kategori }}</td>
                            <td>{{ $book->tahun_terbit }}</td>
                            <td>
                                <div class="actions">
                                    @can('buku.update')
                                        <a class="btn" href="{{ route('books.edit', $book) }}">Edit</a>
                                    @endcan

                                    @can('buku.delete')
                                        <form method="POST"
                                            action="{{ route('books.destroy', $book) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Hapus</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:35px;">
                                Belum ada data buku. Tambahkan buku pertama!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">{{ $books->links() }}</div>
    </div>
@endsection
