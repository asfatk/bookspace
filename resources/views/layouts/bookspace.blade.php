<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BookSpace')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --navy: #142744;
            --navy-light: #203b61;
            --gold: #e8bd70;
            --bg: #f3f6fb;
            --text: #26354a;
            --muted: #718096;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
        }
        .sidebar {
            width: 245px;
            min-height: 100vh;
            background: var(--navy);
            color: white;
            padding: 28px 18px;
            position: fixed;
            top: 0;
            left: 0;
        }
        .brand {
            font-size: 25px;
            font-weight: 800;
            color: white;
            margin: 0 10px 8px;
        }
        .brand span { color: var(--gold); }
        .brand-sub {
            color: #c0ccdc;
            font-size: 12px;
            margin: 0 10px 35px;
        }
        .nav-link {
            display: block;
            padding: 13px 14px;
            margin: 5px 0;
            color: #d9e2ef;
            text-decoration: none;
            border-radius: 9px;
        }
        .nav-link:hover, .nav-link.active {
            background: var(--navy-light);
            color: white;
        }
        .main {
            margin-left: 245px;
            padding: 30px;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
        }
        h1 { margin: 0 0 8px; font-size: 27px; }
        .muted { color: var(--muted); }
        .card {
            background: white;
            padding: 24px;
            border-radius: 15px;
            box-shadow: 0 5px 22px #152b4510;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 16px;
            border: 0;
            border-radius: 8px;
            background: var(--navy);
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn:hover { background: var(--navy-light); }
        .btn-gold { background: var(--gold); color: #17253a; }
        .btn-danger { background: #b83b4b; }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid #e7edf5;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #f7f9fc;
            color: #56657b;
            font-size: 12px;
            text-transform: uppercase;
        }
        input, select, textarea {
            display: block;
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d7dfeb;
            border-radius: 8px;
            margin-top: 7px;
            font: inherit;
        }
        label { display: block; margin-bottom: 18px; font-weight: 600; }
        .alert {
            padding: 13px 16px;
            background: #e4f6e9;
            border-radius: 9px;
            margin-bottom: 18px;
        }
        .error { color: #b42335; font-size: 13px; margin-top: 5px; }
        .actions { display: flex; flex-wrap: wrap; gap: 8px; }
        .pagination { margin-top: 18px; }
        @media (max-width: 760px) {
            .sidebar { position: static; width: 100%; min-height: auto; }
            .main { margin-left: 0; padding: 18px; }
            .topbar { align-items: flex-start; flex-direction: column; }
            .table-wrap { overflow-x: auto; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="brand">Book<span>Space</span></div>
        <div class="brand-sub">Sistem Manajemen Buku</div>

        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>

        @can('buku.view')
            <a class="nav-link" href="{{ route('books.index') }}">Manajemen Buku</a>
        @endcan

        @can('role.manage')
            <a class="nav-link" href="{{ route('users.roles') }}">Manajemen Pengguna</a>
        @endcan

        <div style="margin-top: 35px; padding: 12px; color: #c0ccdc; font-size: 13px;">
            {{ auth()->user()->name ?? 'Pengguna' }}<br>
            <span>{{ auth()->user()->getRoleNames()->implode(', ') }}</span>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="nav-link" type="submit"
                style="width:100%; border:0; text-align:left; cursor:pointer; background:transparent;">
                Keluar
            </button>
        </form>
    </aside>

    <main class="main">
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert" style="background:#fff0f0; color:#a32636;">
                Ada data yang perlu diperbaiki. Periksa kembali formulirnya.
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
