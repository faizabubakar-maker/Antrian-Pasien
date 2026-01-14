<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Tahoma,sans-serif;}
        body{display:flex;justify-content:center;align-items:center;min-height:100vh;background:linear-gradient(135deg,#ffe4e1,#fff0f5,#fff5f8);background-size:400% 400%;animation:gradientBG 15s ease infinite;}
        @keyframes gradientBG{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
        .card{background:#fff;padding:50px 35px;border-radius:20px;box-shadow:0 15px 40px rgba(0,0,0,0.15);width:100%;max-width:400px;transition:0.3s;}
        .card:hover{transform:translateY(-5px);box-shadow:0 25px 50px rgba(0,0,0,0.2);}
        h2{text-align:center;margin-bottom:40px;color:#d63384;letter-spacing:1px;text-shadow:0 2px 5px rgba(0,0,0,0.1);}
        .form-group{position:relative;margin-bottom:30px;}
        .form-group input{width:100%;padding:15px;border:1px solid #ddd;border-radius:10px;outline:none;transition:0.3s;font-size:1rem;}
        .form-group input:focus{border-color:#d63384;box-shadow:0 0 10px rgba(214,51,132,0.3);}
        .form-group label{position:absolute;left:15px;top:50%;transform:translateY(-50%);background:white;padding:0 5px;color:#aaa;pointer-events:none;transition:0.3s;}
        .form-group input:focus + label,.form-group input:not(:placeholder-shown) + label{top:-10px;left:10px;font-size:0.85rem;color:#d63384;}
        button{width:100%;padding:15px;background-color:#d63384;border:none;border-radius:10px;color:white;font-weight:bold;font-size:1rem;cursor:pointer;transition:0.3s;box-shadow:0 5px 15px rgba(214,51,132,0.3);}
        button:hover{background-color:#c21870;transform:scale(1.05);box-shadow:0 8px 20px rgba(214,51,132,0.4);}
        .links{text-align:center;margin-top:20px;}
        .links a{color:#d63384;text-decoration:none;margin:0 8px;font-size:0.9rem;transition:0.3s;}
        .links a:hover{text-decoration:underline;color:#c21870;}
        p.error{color:#e74c3c;text-align:center;margin-bottom:15px;font-weight:bold;}
        p.success{color:#2ecc71;text-align:center;margin-bottom:15px;font-weight:bold;}
        @media(max-width:500px){.card{padding:40px 25px;}button{padding:12px;}}
    </style>
</head>
<body>
    <div class="card">
        <h2>Register</h2>

        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="name" placeholder=" " required>
                <label>Nama Lengkap</label>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder=" " required>
                <label>Email</label>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder=" " required>
                <label>Password</label>
            </div>

            <button type="submit">Register</button>
        </form>

        <div class="links">
            <a href="/login">Login</a>
        </div>
    </div>
</body>
</html>