<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(160deg, #f2f4f9 0%, #fef4ed 100%);
        }

        .box {
            width: min(560px, 92%);
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(31, 37, 46, 0.1);
        }

        h1 {
            margin: 0;
            font-size: 34px;
        }

        p {
            color: #667085;
        }

        a {
            display: inline-block;
            margin-top: 12px;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 10px;
            background: #dc5b3f;
            color: #fff;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>403</h1>
        <p>Ban khong co quyen truy cap trang nay.</p>
        <a href="{{ route('dashboard') }}">Ve Dashboard</a>
    </div>
</body>

</html>