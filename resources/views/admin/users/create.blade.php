<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(140deg, #f3f7ff 0%, #fff7ef 100%);
            padding: 24px 14px;
        }

        .card {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 15px 35px rgba(37, 47, 63, 0.1);
            padding: 20px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: 600;
        }

        input,
        select {
            width: 100%;
            box-sizing: border-box;
            margin-top: 6px;
            padding: 10px;
            border: 1px solid #d8dfe7;
            border-radius: 8px;
        }

        .error {
            color: #b01f1f;
            font-size: 13px;
            margin-top: 4px;
        }

        .btn {
            display: inline-block;
            margin-top: 18px;
            border: 0;
            border-radius: 9px;
            padding: 10px 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: #145fb3;
            color: #fff;
        }

        .btn-outline {
            border: 1px solid #ccd7e4;
            color: #334155;
            background: #fff;
            margin-left: 8px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Tao user moi</h1>

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <label for="role">Role</label>
            <select id="role" name="role" required>
                @foreach ($roles as $role)
                <option value="{{ $role }}" {{ old('role', 'user') === $role ? 'selected' : '' }}>{{ $role }}</option>
                @endforeach
            </select>
            @error('role') <div class="error">{{ $message }}</div> @enderror

            <button class="btn btn-primary" type="submit">Create</button>
            <a class="btn btn-outline" href="{{ route('admin.users.index') }}">Back</a>
        </form>
    </div>
</body>

</html>