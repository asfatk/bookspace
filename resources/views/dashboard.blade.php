@extends('layouts.bookspace')

@section('title', 'Dashboard - BookSpace')

@section('content')
    <div class="topbar">
        <div>
            <h1>Dashboard</h1>
            <div class="muted">Selamat datang di sistem manajemen buku.</div>
        </div>
    </div>

    <div class="card">
        <h2>Halo, {{ auth()->user()->name }}!</h2>
        <p class="muted">
            Kamu login sebagai
            <strong>{{ auth()->user()->getRoleNames()->implode(', ') }}</strong>.
        </p>

        @can('buku.view')
            <a href="{{ route('books.index') }}" class="btn">Buka Manajemen Buku</a>
        @endcan

        @can('role.manage')
            <a href="{{ route('users.roles') }}" class="btn btn-gold">
                Kelola Pengguna
            </a>
        @endcan
    </div>
@endsection
