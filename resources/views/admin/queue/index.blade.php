<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kelola Antrian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Tahoma, sans-serif; }
        body {
            background: linear-gradient(135deg,#ffe4e1,#fff0f5,#fff5f8);
            padding:20px;
        }
        h2 { color:#d63384; text-align:center; margin-bottom:20px; }
        h3 { color:#d63384; margin-top:30px; }

        .flash-message { text-align:center; margin-bottom:15px; font-weight:bold; }
        .flash-success { color:green; }
        .flash-error { color:red; }

        .back-button {
            display:inline-block;
            margin-bottom:15px;
            padding:8px 12px;
            background:#d63384;
            color:white;
            border-radius:6px;
            text-decoration:none;
            font-weight:bold;
        }
        .back-button:hover { background:#c2185b; }

        .filter-form {
            text-align:center;
            margin-bottom:20px;
        }
        .filter-form input[type="date"] {
            padding:8px 10px;
            border-radius:6px;
            border:1px solid #ffc0cb;
            margin-right:5px;
        }
        .filter-form button {
            padding:8px 12px;
            border:none;
            border-radius:6px;
            background:#d63384;
            color:white;
            cursor:pointer;
            transition:0.3s;
        }
        .filter-form button:hover { background:#c2185b; }

        table {
            width:100%;
            border-collapse:collapse;
            background:white;
            border-radius:10px;
            overflow:hidden;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
        th, td {
            padding:12px;
            border:1px solid #ffc0cb;
            text-align:left;
        }
        th { background:#ffe4e1; color:#d63384; }

        td select {
            padding:5px 8px;
            border-radius:6px;
            border:1px solid #ffc0cb;
        }
        td button {
            padding:5px 10px;
            background:#d63384;
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
            transition:0.3s;
        }
        td button:hover { background:#c2185b; }

        .call-next-form {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:10px;
        }
        .call-next-form button {
            padding:6px 12px;
            background:#ff4d6d;
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
            transition:0.3s;
        }
        .call-next-form button:hover { background:#e03e5d; }
        .call-next-form strong { margin-right:10px; }

        @media(max-width:600px){
            th, td { font-size:0.85rem; padding:8px; }
            td select, td button, .call-next-form button { font-size:0.85rem; padding:5px; }
        }
    </style>
</head>
<body>

<h2>Kelola Antrian</h2>

@if(session('success'))
    <p class="flash-message flash-success">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p class="flash-message flash-error">{{ session('error') }}</p>
@endif

<div class="filter-form">
    <form method="GET" action="{{ route('admin.queue.index') }}">
        <label>Filter Tanggal:</label>
        <input type="date" name="tanggal" value="{{ $tanggal ?? '' }}">
        <button type="submit">Tampilkan</button>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Pasien</th>
            <th>Dokter</th>
            <th>Poli</th>
            <th>Tanggal</th>
            <th>Nomor</th>
            <th>Keluhan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($antrians as $a)
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
                <form action="{{ route('admin.queue.updateStatus', $a->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('PATCH')
                    <select name="status">
                        <option value="WAITING" @if($a->status==='WAITING') selected @endif>WAITING</option>
                        <option value="CALLED" @if($a->status==='CALLED') selected @endif>CALLED</option>
                        <option value="DONE" @if($a->status==='DONE') selected @endif>DONE</option>
                        <option value="CANCELED" @if($a->status==='CANCELED') selected @endif>CANCELED</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" style="text-align:center;">Belum ada antrian untuk tanggal ini</td>
        </tr>
        @endforelse
    </tbody>
</table>

<hr>

<h3>Panggil Nomor Berikutnya</h3>
@foreach($dokters as $dokter)
    <form class="call-next-form" action="{{ route('admin.queue.callNext', $dokter->id) }}" method="POST">
        @csrf
        <strong>{{ $dokter->name }} - {{ $dokter->poli->name }} ({{ $dokter->schedule_day }})</strong>
        <button type="submit">Call Next</button>
    </form>
@endforeach

<a href="{{ route('admin.dashboard') }}" class="back-button">⬅ Kembali ke Dashboard</a>

</body>
</html>