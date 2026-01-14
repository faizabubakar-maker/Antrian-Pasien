<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Antrian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Tahoma, sans-serif;}
        body {
            background: linear-gradient(135deg,#ffe4e1,#fff0f5,#fff5f8);
            padding:20px;
        }
        h2 {
            text-align:center;
            color:#d63384;
            margin-bottom:20px;
        }
        .table-container {
            max-width:1000px;
            margin:0 auto;
            background:white;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
            padding:20px;
            overflow-x:auto;
        }
        table {
            width:100%;
            border-collapse: collapse;
            min-width:700px;
        }
        th, td {
            padding:12px;
            border-bottom:1px solid #ffd6e0;
            text-align:left;
        }
        th {
            background:#ffe0eb;
            color:#d63384;
            font-weight:600;
        }
        tr:nth-child(even) {background:#fff0f5;}
        tr:hover {background:#ffe4e1;}
        .status {
            padding:5px 10px;
            border-radius:8px;
            color:white;
            font-weight:bold;
            text-align:center;
        }
        .WAITING {background:#ff6f91;}
        .CALLED {background:#ffa07a;}
        .DONE {background:#32cd32;}
        .CANCELED {background:#a9a9a9;}
        button {
            padding:5px 10px;
            border:none;
            border-radius:6px;
            background:#d63384;
            color:white;
            font-weight:bold;
            cursor:pointer;
        }
        button:hover {background:#c2185b;}
        a.back-link {
            display:block;
            text-align:center;
            margin-top:20px;
            color:#d63384;
            text-decoration:none;
            font-weight:bold;
        }
        a.back-link:hover {text-decoration:underline;}
        .message {text-align:center; margin-bottom:15px;}
        .success {color:#32cd32;}
        .error {color:#ff4d6d;}
        @media(max-width:700px){
            th, td {padding:8px;}
            table {min-width:100%;}
        }
    </style>
</head>
<body>

<h2>Riwayat Antrian</h2>

@if(session('success'))
    <p class="message success">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p class="message error">{{ session('error') }}</p>
@endif

<div class="table-container">
    @if($antrians->isEmpty())
        <p style="text-align:center; color:#d63384; font-weight:bold;">Belum ada antrian</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Antrian</th>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Tanggal Kunjungan</th>
                    <th>Keluhan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($antrians as $antrian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $antrian->nomor_antrian }}</td>
                    <td>{{ $antrian->dokter->name }}</td>
                    <td>{{ $antrian->dokter->poli->name }}</td>
                    <td>{{ $antrian->tanggal_kunjungan }}</td>
                    <td>{{ $antrian->keluhan }}</td>
                    <td><span class="status {{ $antrian->status }}">{{ $antrian->status }}</span></td>
                    <td>
                        @if($antrian->status === 'WAITING')
                            <form method="POST"
                                  action="{{ route('antrian.cancel', $antrian->id) }}"
                                  onsubmit="return confirm('Batalkan antrian ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Cancel</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:15px;">{{ $antrians->links() }}</div>
    @endif
</div>

<a class="back-link" href="{{ route('user.dashboard') }}">Kembali ke Dashboard</a>

</body>
</html>