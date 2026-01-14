<!DOCTYPE html>
<html>
<head>
    <title>Daftar Dokter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Tahoma, sans-serif; }
        body {
            background: linear-gradient(135deg, #ffe4e1, #fff0f5, #fff5f8);
            padding:20px;
        }
        h2 {
            text-align:center;
            color:#d63384;
            margin-bottom:20px;
        }
        .flash-message {
            text-align:center;
            color:green;
            margin-bottom:15px;
            font-weight:bold;
        }
        .add-button {
            display:inline-block;
            background:#d63384;
            color:white;
            padding:8px 15px;
            border-radius:8px;
            text-decoration:none;
            font-weight:bold;
            margin-bottom:15px;
            transition:0.3s;
        }
        .add-button:hover { background:#c2185b; }

        table {
            width:100%;
            border-collapse:collapse;
            background:white;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
        th, td {
            border:1px solid #ffc0cb;
            padding:12px 15px;
            text-align:left;
        }
        th {
            background:#ffe4e1;
            color:#d63384;
        }
        td a, td button {
            margin-right:8px;
        }
        td a {
            color:#fff;
            background:#d63384;
            padding:5px 10px;
            border-radius:6px;
            text-decoration:none;
            font-size:0.9rem;
        }
        td a:hover { background:#c2185b; }
        td button {
            background:#ff4d6d;
            color:white;
            border:none;
            padding:5px 10px;
            border-radius:6px;
            cursor:pointer;
            font-size:0.9rem;
            transition:0.3s;
        }
        td button:hover { background:#e03e5d; }

        a.back-link {
            display:block;
            text-align:center;
            margin-top:20px;
            color:#d63384;
            font-weight:bold;
            text-decoration:none;
        }
        a.back-link:hover { text-decoration:underline; }

        @media(max-width:600px){
            th, td { font-size:0.85rem; padding:8px 10px; }
            .add-button { padding:6px 10px; font-size:0.9rem; }
        }
    </style>
</head>
<body>

<h2>Daftar Dokter</h2>

@if(session('success'))
    <p class="flash-message">{{ session('success') }}</p>
@endif

<a class="add-button" href="{{ route('admin.dokters.create') }}">+ Tambah Dokter</a>

<table>
    <tr>
        <th>No</th>
        <th>Nama Dokter</th>
        <th>Poli</th>
        <th>Hari Jadwal</th>
        <th>Jam</th>
        <th>Aksi</th>
    </tr>
    @forelse($dokters as $dokter)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $dokter->name }}</td>
        <td>{{ $dokter->poli->name }}</td>
        <td>{{ $dokter->schedule_day }}</td>
        <td>{{ $dokter->start_time }} - {{ $dokter->end_time }}</td>
        <td>
            <a href="{{ route('admin.dokters.edit', $dokter) }}">Edit</a>
            <form action="{{ route('admin.dokters.destroy', $dokter) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus dokter ini?')">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" style="text-align:center; color:#d63384; font-weight:bold;">
            Belum ada data dokter
        </td>
    </tr>
    @endforelse
</table>

<a class="back-link" href="{{ route('admin.dashboard') }}">← Kembali ke Dashboard</a>

{{ $dokters->links() }}

</body>
</html>