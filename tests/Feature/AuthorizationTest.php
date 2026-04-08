<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_for_protected_routes(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
        $this->get(route('admin.index'))->assertRedirect(route('login'));
        $this->get(route('admin.users.index'))->assertRedirect(route('login'));
    }

    public function test_user_can_access_dashboard_and_sees_user_message(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSeeText('Welcome User');
    }

    public function test_user_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $this->actingAs($user)->get(route('admin.index'))->assertForbidden();
        $this->actingAs($user)->get(route('admin.users.index'))->assertForbidden();
    }

    public function test_admin_can_access_admin_pages_and_sees_admin_message(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin)->get(route('admin.index'))->assertOk();
        $this->actingAs($admin)->get(route('admin.users.index'))->assertOk();

        $this->actingAs($admin)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSeeText('Welcome Admin');
    }

    public function test_admin_can_create_user(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->post(route('admin.users.store'), [
                'name' => 'Created User',
                'email' => 'created@example.com',
                'password' => '123456',
                'role' => 'user',
            ])
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'created@example.com',
            'role' => 'user',
        ]);
    }

    public function test_admin_can_update_user_without_changing_password(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $target = User::factory()->create([
            'password' => 'old-password',
            'role' => 'user',
        ]);

        $oldPasswordHash = $target->password;

        $this->actingAs($admin)
            ->put(route('admin.users.update', $target), [
                'name' => 'Updated Name',
                'email' => $target->email,
                'password' => '',
                'role' => 'admin',
            ])
            ->assertRedirect(route('admin.users.index'));

        $target->refresh();

        $this->assertSame('Updated Name', $target->name);
        $this->assertSame('admin', $target->role);
        $this->assertSame($oldPasswordHash, $target->password);
        $this->assertTrue(Hash::check('old-password', $target->password));
    }

    public function test_admin_can_update_role_inline(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $target = User::factory()->create([
            'role' => 'user',
        ]);

        $this->actingAs($admin)
            ->patch(route('admin.users.update-role', $target), [
                'role' => 'admin',
            ])
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'id' => $target->id,
            'role' => 'admin',
        ]);
    }

    public function test_admin_cannot_delete_self(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->from(route('admin.users.index'))
            ->delete(route('admin.users.destroy', $admin))
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHasErrors('delete');

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
        ]);
    }
}
