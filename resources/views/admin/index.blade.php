<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        :root {
            --bg: #f2efe8;
            --panel: #fffdf8;
            --text: #1d1e22;
            --muted: #6a6e79;
            --accent: #c4472d;
            --accent-dark: #8e2613;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at top right, #ffdcc8 0%, var(--bg) 45%, #e8f1f6 100%);
            color: var(--text);
            min-height: 100vh;
            padding: 30px 16px;
        }

        .container {
            max-width: 980px;
            margin: 0 auto;
            background: var(--panel);
            border-radius: 18px;
            padding: 26px;
            box-shadow: 0 18px 40px rgba(38, 34, 29, 0.12);
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            border: 0;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-outline {
            color: var(--accent-dark);
            border: 1px solid #d7b0a8;
            background: #fff;
        }

        .grid {
            margin-top: 22px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 14px;
        }

        .card {
            background: #fff;
            border: 1px solid #ecdcd2;
            border-radius: 12px;
            padding: 16px;
        }

        .muted {
            color: var(--muted);
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="topbar">
            <div>
                <h1>Admin Panel</h1>
                <p class="muted">Xin chao, {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>
            </div>

            <div>
                <a class="btn btn-outline" href="{{ route('dashboard') }}">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline-block; margin-left:8px;">
                    @csrf
                    <button class="btn btn-primary" type="submit">Dang xuat</button>
                </form>
            </div>
        </div>

        <div class="grid">
            <div class="card">
                <h3>Quan ly users</h3>
                <p class="muted">Xem danh sach va CRUD user trong he thong.</p>
                <a class="btn btn-primary" href="{{ route('admin.users.index') }}">Di toi /admin/users</a>
            </div>
        </div>
    </div>
</body>

</html>