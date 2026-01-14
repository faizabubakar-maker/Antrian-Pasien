<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Tahoma,sans-serif;}
        body {
            background: linear-gradient(135deg,#ffe4e1,#fff0f5,#fff5f8);
            padding:20px;
        }
        h2 {color:#d63384;text-align:center;margin-bottom:10px;}
        p {text-align:center;margin-bottom:15px;font-weight:bold;color:#c21870;}

        .nav {
            text-align:center;
            margin-bottom:20px;
        }
        .nav a, .nav form button {
            display:inline-block;
            margin:5px 10px;
            padding:10px 15px;
            background:#d63384;
            color:white;
            text-decoration:none;
            border:none;
            border-radius:8px;
            cursor:pointer;
            transition:0.3s;
        }
        .nav a:hover, .nav form button:hover {background:#c21870;transform:scale(1.05);}

        table {
            width:100%;
            border-collapse: collapse;
            margin-top:15px;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
        th, td {
            padding:12px 15px;
            text-align:left;
        }
        th {
            background:#ffd6e0;
            color:#d63384;
        }
        tr:nth-child(even) {background:#fff0f5;}
        tr:hover {background:#ffe4e1;}

        .success-msg {
            color:green;
            font-weight:bold;
            text-align:center;
            margin-bottom:15px;
        }

        @media(max-width:800px){
            table, th, td {font-size:0.85rem;}
            .nav a, .nav form button {padding:8px 12px;margin:3px;}
        }
    </style>
</head>
<body>

<h2>Dashboard User</h2>
<p>Halo, {{ auth()->user()->name }}</p>

<div class="nav">
    <a href="{{ route('antrian.create') }}">Daftar Antrian</a>
    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

@if(session('success'))
    <p class="success-msg">{{ session('success') }}</p>
@endif

@if($antrians->isEmpty())
    <p style="text-align:center;color:#c21870;font-weight:bold;">Belum ada antrian</p>
@else
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Dokter</th>
                <th>Poli</th>
                <th>Tanggal</th>
                <th>Nomor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($antrians as $a)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $a->dokter->name }}</td>
                <td>{{ $a->dokter->poli->name }}</td>
                <td>{{ $a->tanggal_kunjungan }}</td>
                <td>{{ $a->nomor_antrian }}</td>
                <td>{{ $a->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:10px;text-align:center;">
        {{ $antrians->links() }}
    </div>
@endif

</body>
</html>