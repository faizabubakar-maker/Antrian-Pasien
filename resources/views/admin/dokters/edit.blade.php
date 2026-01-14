<!DOCTYPE html>
<html>
<head>
    <title>Edit Dokter</title>
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
            color:red;
            margin-bottom:15px;
            font-weight:bold;
        }
        form {
            max-width:500px;
            margin:0 auto;
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
        label {
            display:block;
            margin-bottom:6px;
            font-weight:bold;
            color:#d63384;
        }
        input, select {
            width:100%;
            padding:8px 10px;
            margin-bottom:15px;
            border:1px solid #ffc0cb;
            border-radius:8px;
            font-size:1rem;
        }
        button {
            background:#d63384;
            color:white;
            padding:10px 20px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
            transition:0.3s;
        }
        button:hover { background:#c2185b; }
        a.back-link {
            display:block;
            text-align:center;
            margin-top:15px;
            color:#d63384;
            font-weight:bold;
            text-decoration:none;
        }
        a.back-link:hover { text-decoration:underline; }

        @media(max-width:600px){
            form { padding:15px; }
            input, select { font-size:0.9rem; }
            button { width:100%; }
        }
    </style>
</head>
<body>

<h2>Edit Dokter</h2>

@if ($errors->any())
    <p class="flash-message">{{ $errors->first() }}</p>
@endif

<form method="POST" action="{{ route('admin.dokters.update', $dokter) }}">
    @csrf
    @method('PUT')

    <label>Nama Dokter</label>
    <input type="text" name="name" value="{{ old('name',$dokter->name) }}" required>

    <label>Poli</label>
    <select name="poli_id" required>
        @foreach($polis as $p)
            <option value="{{ $p->id }}" @if($p->id==$dokter->poli_id) selected @endif>{{ $p->name }}</option>
        @endforeach
    </select>

    <label>Hari Jadwal</label>
    <input type="text" name="schedule_day" value="{{ old('schedule_day',$dokter->schedule_day) }}" required>

    <label>Jam Mulai</label>
    <input type="time" name="start_time" value="{{ old('start_time',$dokter->start_time) }}" required>

    <label>Jam Selesai</label>
    <input type="time" name="end_time" value="{{ old('end_time',$dokter->end_time) }}" required>

    <button type="submit">Update</button>
</form>

<a class="back-link" href="{{ route('admin.dokters.index') }}">← Kembali ke Daftar Dokter</a>

</body>
</html>