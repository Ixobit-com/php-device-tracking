<?php

namespace Tests\Feature\Admin\User;

use App\Http\Livewire\Admin\User\Update;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class UserUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user's main fields can be updated successfully.
     *
     * @return void
     */
    public function testCanUpdateUserMainFields(): void
    {
        $user = User::factory()->create();
        Livewire::test(Update::class, ['userId' => $user->id])
            ->set('name', 'New Name')
            ->set('email', 'newemail@example.com')
            ->set('role', 'user')
            ->call('update');

        $this->assertDatabaseHas('users', ['name' => 'New Name', 'email' => 'newemail@example.com', 'role' => 'user']);
    }

    /**
     * Test that you cannot ban an admin user.
     *
     * @return void
     */
    public function testCannotBanAdmin(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Livewire::test(Update::class, ['userId' => $admin->id])
            ->call('banUser');

        $this->assertNull(User::find($admin->id)->banned_at);
    }

    /**
     * Test that a user's password can be updated successfully.
     *
     * @return void
     */
    public function testCanUpdateUserPassword(): void
    {
        $user = User::factory()->create();
        Livewire::test(Update::class, ['userId' => $user->id])
            ->set('password', 'pAss1$qwe')
            ->set('password_confirmation', 'pAss1$qwe')
            ->call('updatePassword');

        $updatedUser = User::find($user->id);
        $this->assertTrue(Hash::check('pAss1$qwe', $updatedUser->password));
    }

    /**
     * Test that a user can be unbanned successfully.
     *
     * @return void
     */
    public function testCanUnbanUser(): void
    {
        $user = User::factory()->create();
        $user->update(['banned_at' => now()]);
        Livewire::test(Update::class, ['userId' => $user->id])
            ->call('unbanUser');

        $this->assertNull(User::find($user->id)->banned_at);
    }

    /**
     * Test that a user can be banned successfully.
     *
     * @return void
     */
    public function testCanBanUser(): void
    {
        $userToBan = User::factory()->create();
        $admin     = User::factory()->create(['role' => 'admin']);
        Livewire::actingAs($admin)
            ->test(Update::class, ['userId' => $userToBan->id])
            ->call('banUser');

        $this->assertNotNull(User::find($userToBan->id)->banned_at);
    }

    /**
     * Test validation for the 'name' field.
     *
     * @return void
     */
    public function testNameValidation(): void
    {
        $user = User::factory()->create();
        Livewire::test(Update::class, ['userId' => $user->id])
            ->set('name', '')
            ->call('update')
            ->assertHasErrors(['name']);
    }

    /**
     * Test validation for the 'email' field.
     *
     * @return void
     */
    public function testEmailValidation(): void
    {
        $user = User::factory()->create();
        Livewire::test(Update::class, ['userId' => $user->id])
            ->set('email', 'invalid_email')
            ->call('update')
            ->assertHasErrors(['email']);
    }

    /**
     * Test validation for the 'role' field.
     *
     * @return void
     */
    public function testRoleValidation(): void
    {
        $user = User::factory()->create();
        Livewire::test(Update::class, ['userId' => $user->id])
            ->set('role', 'invalid_role')
            ->call('update')
            ->assertHasErrors(['role']);
    }
}
