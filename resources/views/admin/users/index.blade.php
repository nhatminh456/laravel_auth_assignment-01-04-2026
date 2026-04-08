<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        :root {
            --bg: #eef1ed;
            --panel: #fefefe;
            --text: #1f2937;
            --muted: #6b7280;
            --line: #d9dce2;
            --danger: #c3261d;
            --accent: #146356;
            --admin: #8f3dff;
            --user: #1c7ed6;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at 15% 15%, #e7f7f0 0%, var(--bg) 40%, #f7ece8 100%);
            color: var(--text);
            padding: 30px 16px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: var(--panel);
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(36, 42, 55, 0.12);
            padding: 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            border: 0;
            border-radius: 9px;
            padding: 9px 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-outline {
            background: #fff;
            color: #243248;
            border: 1px solid var(--line);
        }

        .btn-danger {
            background: var(--danger);
            color: #fff;
        }

        .alert {
            margin-top: 14px;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 14px;
        }

        .alert-success {
            background: #e8faf0;
            border: 1px solid #91d3ae;
            color: #155d3a;
        }

        .alert-error {
            background: #fff1f1;
            border: 1px solid #ef9a9a;
            color: #8a1c1c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
            font-size: 14px;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid var(--line);
            text-align: left;
            vertical-align: middle;
        }

        .badge {
            display: inline-block;
            min-width: 60px;
            text-align: center;
            border-radius: 999px;
            padding: 4px 10px;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-admin {
            background: var(--admin);
        }

        .badge-user {
            background: var(--user);
        }

        select {
            padding: 6px;
            border-radius: 8px;
            border: 1px solid var(--line);
        }

        .inline {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        @media (max-width: 860px) {

            table,
            thead,
            tbody,
            tr,
            th,
            td {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                border: 1px solid var(--line);
                border-radius: 12px;
                margin-bottom: 12px;
                overflow: hidden;
            }

            td {
                border-bottom: 1px solid var(--line);
            }

            td:last-child {
                border-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="topbar">
            <div>
                <h1>Admin / Users</h1>
                <div style="color: var(--muted)">Danh sach user va quan ly role.</div>
            </div>

            <div class="actions">
                <a class="btn btn-outline" href="{{ route('admin.index') }}">/admin</a>
                <a class="btn btn-primary" href="{{ route('admin.users.create') }}">+ Tao user</a>
            </div>
        </div>

        @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if ($errors->has('delete'))
        <div class="alert alert-error">{{ $errors->first('delete') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Quick role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge {{ $user->role === 'admin' ? 'badge-admin' : 'badge-user' }}">{{ $user->role }}</span>
                    </td>
                    <td>
                        <form class="inline" method="POST" action="{{ route('admin.users.update-role', $user) }}">
                            @csrf
                            @method('PATCH')
                            <select name="role" onchange="this.form.submit()">
                                @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>
                        <div class="inline">
                            <a class="btn btn-outline" href="{{ route('admin.users.edit', $user) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Xac nhan xoa user nay?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>