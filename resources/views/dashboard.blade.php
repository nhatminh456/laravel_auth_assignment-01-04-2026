<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        .container {
            max-width: 760px;
            margin: 40px auto;
            background: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
        }

        .card {
            background: #f8fafc;
            border: 1px solid #e8edf3;
            padding: 16px;
            border-radius: 8px;
            margin-top: 12px;
        }

        .label {
            color: #5f6d7a;
            font-size: 14px;
        }

        .value {
            font-size: 18px;
            margin-top: 2px;
        }

        .logout-btn {
            margin-top: 18px;
            padding: 10px 18px;
            border: 0;
            border-radius: 6px;
            background: #dc3545;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Dashboard</h1>
        <p>Ban da dang nhap thanh cong.</p>

        <div class="card">
            <div class="label">Ten</div>
            <div class="value">{{ $user->name }}</div>
        </div>

        <div class="card">
            <div class="label">Email</div>
            <div class="value">{{ $user->email }}</div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn" type="submit">Dang xuat</button>
        </form>
    </div>
</body>

</html>