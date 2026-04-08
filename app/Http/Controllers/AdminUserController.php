<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->latest()->get(),
            'roles' => config('roles', []),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'roles' => config('roles', []),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', Rule::in(config('roles', []))],
        ]);

        User::query()->create($validated);

        return redirect()->route('admin.users.index')->with('status', 'Tao user thanh cong.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => config('roles', []),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6'],
            'role' => ['required', Rule::in(config('roles', []))],
        ]);

        if ($validated['password'] === null || $validated['password'] === '') {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('status', 'Cap nhat user thanh cong.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()?->id === $user->id) {
            return back()->withErrors([
                'delete' => 'Ban khong the tu xoa tai khoan admin dang dang nhap.',
            ]);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'Da xoa user.');
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in(config('roles', []))],
        ]);

        $user->update([
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('status', 'Cap nhat role thanh cong.');
    }
}
