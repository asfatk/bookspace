@extends('layouts.bookspace')

@section('title', 'Manajemen Pengguna - BookSpace')

@section('content')
    <div class="topbar">
        <div>
            <h1>Manajemen Pengguna</h1>
            <div class="muted">Atur hak akses Admin, Dosen, dan Mahasiswa.</div>
        </div>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role Saat Ini</th>
                        <th>Ubah Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                            <td>
                                @if (auth()->id() !== $user->id)
                                    <form method="POST"
                                        action="{{ route('users.roles.update', $user) }}">
                                        @csrf
                                        @method('PUT')

                                        <select name="role" required>
                                            @foreach (['Admin', 'Dosen', 'Mahasiswa'] as $role)
                                                <option value="{{ $role }}"
                                                    @selected($user->hasRole($role))>
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <button class="btn" type="submit" style="margin-top:8px;">
                                            Simpan Role
                                        </button>
                                    </form>
                                @else
                                    <span class="muted">Role akun sendiri tidak dapat diubah di sini.</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination">{{ $users->links() }}</div>
    </div>
@endsection
