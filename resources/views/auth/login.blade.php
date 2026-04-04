<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        .container {
            max-width: 420px;
            margin: 40px auto;
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            font-size: 24px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .remember {
            margin-top: 12px;
            font-size: 14px;
        }

        .error {
            color: #d11a2a;
            font-size: 14px;
            margin-top: 4px;
        }

        .btn {
            margin-top: 16px;
            width: 100%;
            padding: 10px;
            border: 0;
            border-radius: 6px;
            background: #0d6efd;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }

        .link {
            margin-top: 12px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Dang nhap</h1>

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            <label class="remember">
                <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                Nho dang nhap
            </label>

            <button class="btn" type="submit">Dang nhap</button>
        </form>

        <div class="link">
            Chua co tai khoan? <a href="{{ route('register') }}">Dang ky</a>
        </div>
    </div>
</body>

</html>