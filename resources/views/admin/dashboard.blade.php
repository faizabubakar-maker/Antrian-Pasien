<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset & font */
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Tahoma, sans-serif; }
        body { background:#fff5f8; padding:20px; }

        h2, h3 { text-align:center; color:#d63384; margin-bottom:15px; }
        h3 { margin-top:30px; }

        /* Navigation */
        nav { text-align:center; margin-bottom:20px; }
        nav a, nav form button {
            display:inline-block;
            margin:5px 10px;
            text-decoration:none;
            padding:8px 15px;
            border-radius:8px;
            font-weight:bold;
            transition:0.3s;
        }
        nav a { background:#d63384; color:white; }
        nav a:hover { background:#c2185b; }
        nav form button { background:#ff4d6d; color:white; border:none; cursor:pointer; }
        nav form button:hover { background:#e03e5d; }

        /* Table styles */
        table {
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
            background:white;
            border-radius:10px;
            overflow:hidden;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
        th, td {
            padding:12px 15px;
            border:1px solid #ffc0cb;
            text-align:left;
        }
        th { background:#ffe4e1; color:#d63384; }
        td form button {
            padding:5px 10px;
            border-radius:6px;
            font-size:0.9rem;
        }

        /* Responsive */
        @media(max-width:600px){
            th, td { font-size:0.85rem; padding:8px 10px; }
            nav a, nav form button { padding:6px 10px; font-size:0.85rem; }
        }
    </style>
</head>
<body>

<h2>Selamat Datang, {{ auth()->user()->name }}</h2>

<nav>
    <a href="{{ route('admin.polis.index') }}">Kelola Poli</a>
    <a href="{{ route('admin.dokters.index') }}">Kelola Dokter</a>
    <a href="{{ route('admin.queue.index') }}">Kelola Antrian</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>

<h3>Antrian Terbaru</h3>

@php
$latest = \App\Models\Antrian::with('dokter.poli','user')
            ->latest('created_at')
            ->take(5)
            ->get();
@endphp

@if($latest->isEmpty())
    <p style="text-align:center; color:#d63384; font-weight:bold;">Belum ada antrian</p>
@else
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Dokter</th>
                <th>Poli</th>
                <th>Tanggal Kunjungan</th>
                <th>Nomor Antrian</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($latest as $a)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $a->user->name }}</td>
                <td>{{ $a->dokter->name }}</td>
                <td>{{ $a->dokter->poli->name }}</td>
                <td>{{ $a->tanggal_kunjungan }}</td>
                <td>{{ $a->nomor_antrian }}</td>
                <td>{{ $a->keluhan }}</td>
                <td>{{ $a->status }}</td>
                <td>
                    @if($a->status === 'WAITING')
                        <form method="POST" action="{{ route('admin.queue.callNext', $a->dokter->id) }}">
                            @csrf
                            <button type="submit">Panggil Berikutnya</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

</body>
</html>