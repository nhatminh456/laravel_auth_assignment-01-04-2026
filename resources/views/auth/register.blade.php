<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
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

        .top-error {
            background: #ffe9ec;
            color: #8a1220;
            border: 1px solid #f3b9c0;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Dang ky</h1>

        @if ($errors->any())
        <div class="top-error">Vui long kiem tra lai thong tin.</div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <label for="password_confirmation">Confirm password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>

            <button class="btn" type="submit">Dang ky</button>
        </form>

        <div class="link">
            Da co tai khoan? <a href="{{ route('login') }}">Dang nhap</a>
        </div>
    </div>
</body>

</html>