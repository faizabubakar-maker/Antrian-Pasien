<!DOCTYPE html>
<html>
<head>
    <title>Edit Poli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Tahoma, sans-serif; }
        body {
            background: linear-gradient(135deg, #ffe4e1, #fff0f5, #fff5f8);
            padding:20px;
        }
        h1 {
            text-align:center;
            color:#d63384;
            margin-bottom:20px;
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
            margin-bottom:8px;
            font-weight:600;
            color:#d63384;
        }
        input[type="text"] {
            width:100%;
            padding:10px;
            margin-bottom:15px;
            border:1px solid #ffc0cb;
            border-radius:8px;
            outline:none;
            transition:0.3s;
        }
        input[type="text"]:focus {
            border-color:#d63384;
            box-shadow:0 0 5px rgba(214,51,132,0.5);
        }
        button {
            background:#d63384;
            color:white;
            padding:10px 20px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
            width:100%;
            transition:0.3s;
        }
        button:hover { background:#c2185b; }
        ul.errors {
            margin-bottom:15px;
            padding-left:20px;
            color:#ff4d6d;
        }
        a.back-link {
            display:block;
            text-align:center;
            margin-top:20px;
            color:#d63384;
            text-decoration:none;
            font-weight:bold;
        }
        a.back-link:hover { text-decoration:underline; }
        @media(max-width:500px){
            form { padding:15px; }
            button { padding:10px; }
        }
    </style>
</head>
<body>

<h1>Edit Poli</h1>

@if ($errors->any())
    <ul class="errors">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('admin.polis.update', $poli->id) }}">
    @csrf
    @method('PUT')

    <label>Nama Poli</label>
    <input type="text" name="name" value="{{ old('name', $poli->name) }}" required>

    <button type="submit">Update</button>
</form>

<a class="back-link" href="{{ route('admin.polis.index') }}">⬅ Kembali</a>

</body>
</html>