<!DOCTYPE html>
<html>
<head>
    <title>Daftar Antrian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Tahoma, sans-serif;}
        body {
            background: linear-gradient(135deg,#ffe4e1,#fff0f5,#fff5f8);
            padding:20px;
        }
        h2 {
            color:#d63384;
            text-align:center;
            margin-bottom:20px;
        }
        .form-container {
            max-width:500px;
            margin:0 auto;
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
        label {
            display:block;
            margin-bottom:5px;
            font-weight:bold;
            color:#d63384;
        }
        select, input, textarea {
            width:100%;
            padding:10px 12px;
            margin-bottom:15px;
            border:1px solid #ffd6e0;
            border-radius:8px;
            font-size:1rem;
        }
        textarea {resize:none;}
        button {
            width:100%;
            padding:12px;
            background:#d63384;
            color:white;
            border:none;
            border-radius:8px;
            font-size:1rem;
            cursor:pointer;
            transition:0.3s;
        }
        button:hover {background:#c21870; transform:scale(1.03);}
        .success-msg {
            color:green;
            font-weight:bold;
            margin-bottom:15px;
            text-align:center;
        }
        .error-msg {
            color:red;
            margin-bottom:15px;
            text-align:center;
        }
        .back-link {
            display:block;
            text-align:center;
            margin-top:15px;
            color:#d63384;
            text-decoration:none;
            font-weight:bold;
        }
        .back-link:hover {text-decoration:underline;}
        @media(max-width:600px){
            .form-container {padding:20px;}
            select, input, textarea, button {font-size:0.9rem;}
        }
    </style>
</head>
<body>

<h2>Daftar Antrian</h2>

<div class="form-container">

    @if(session('success'))
        <p class="success-msg">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <p class="error-msg">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('antrian.store') }}">
        @csrf

        <label for="dokter_id">Dokter</label>
        <select name="dokter_id" id="dokter_id" required>
            <option value="">-- Pilih Dokter --</option>
            @foreach($dokters as $dokter)
                <option value="{{ $dokter->id }}">
                    {{ $dokter->name }} - {{ $dokter->poli->name }} ({{ $dokter->schedule_day }})
                </option>
            @endforeach
        </select>

        <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
        <input type="date" name="tanggal_kunjungan" id="tanggal" required min="{{ date('Y-m-d') }}">

        <label for="keluhan">Keluhan</label>
        <textarea name="keluhan" id="keluhan" rows="4" placeholder="Tulis keluhan Anda..." required></textarea>

        <button type="submit">Daftar Antrian</button>
    </form>

    <a class="back-link" href="{{ route('user.dashboard') }}">Kembali ke Dashboard</a>
</div>

</body>
</html>