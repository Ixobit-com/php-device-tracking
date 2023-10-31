<?php

namespace Tests\Feature\Admin\User;

use App\Http\Livewire\Admin\User\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can be created with valid data.
     *
     * This test checks if a new user can be successfully created using valid data.
     * It sets user details such as name, email, role, password, and password confirmation,
     * then calls the 'store' method and asserts that the user is in the database.
     *
     * @return void
     */
    public function testCanCreateNewUser(): void
    {
        Livewire::test(Create::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('role', 'user')
            ->set('password', 'pAss1$qwe')
            ->set('password_confirmation', 'pAss1$qwe')
            ->call('store');

        $this->assertDatabaseHas('users', ['name' => 'John Doe', 'email' => 'john@example.com']);
    }

    /**
     * Test that user creation requires a name.
     *
     * This test checks if creating a user requires providing a name.
     * It sets an empty name and validates that the 'name' field has validation errors.
     *
     * @return void
     */
    public function testRequiresName(): void
    {
        Livewire::test(Create::class)
            ->set('name', '')
            ->set('email', 'john@example.com')
            ->set('role', 'admin')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->call('store')
            ->assertHasErrors(['name']);
    }

    /**
     * Test that user creation requires a valid email.
     *
     * This test checks if creating a user requires a valid email address.
     * It sets an invalid email and validates that the 'email' field has validation errors.
     *
     * @return void
     */
    public function testRequiresValidEmail(): void
    {
        Livewire::test(Create::class)
            ->set('name', 'John Doe')
            ->set('email', 'invalid-email')
            ->set('role', 'admin')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->call('store')
            ->assertHasErrors(['email']);
    }

    /**
     * Test that user creation requires a valid role.
     *
     * This test checks if creating a user requires a valid role.
     * It sets an invalid role and validates that the 'role' field has validation errors.
     *
     * @return void
     */
    public function testRequiresValidRole(): void
    {
        Livewire::test(Create::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('role', 'invalid-role')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'Password123!')
            ->call('store')
            ->assertHasErrors(['role']);
    }

    /**
     * Test that user creation requires a password.
     *
     * This test checks if creating a user requires providing a password.
     * It sets an empty password and validates that the 'password' field has validation errors.
     *
     * @return void
     */
    public function testRequiresPassword(): void
    {
        Livewire::test(Create::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('role', 'admin')
            ->set('password', '')
            ->set('password_confirmation', 'Password123!')
            ->call('store')
            ->assertHasErrors(['password']);
    }

    /**
     * Test that user creation requires the password to match confirmation.
     *
     * This test checks if creating a user requires the password and password confirmation to match.
     * It sets different values for the password and password confirmation and validates that the 'password' field has validation errors.
     *
     * @return void
     */
    public function testRequiresPasswordToMatchConfirmation(): void
    {
        Livewire::test(Create::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('role', 'admin')
            ->set('password', 'Password123!')
            ->set('password_confirmation', 'DifferentPassword123!')
            ->call('store')
            ->assertHasErrors(['password']);
    }

    /**
     * Test that user creation requires a password to have a minimum length.
     *
     * This test checks if creating a user requires the password to have a minimum length.
     * It sets a short password and validates that the 'password' field has validation errors.
     *
     * @return void
     */
    public function testRequiresPasswordToHaveMinLength(): void
    {
        Livewire::test(Create::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('role', 'admin')
            ->set('password', 'Short1!')
            ->set('password_confirmation', 'Short1!')
            ->call('store')
            ->assertHasErrors(['password']);
    }

    /**
     * Test that user creation requires a password to have a maximum length.
     *
     * This test checks if creating a user requires the password to have a maximum length.
     * It sets a long password and validates that the 'password' field has validation errors.
     *
     * @return void
     */
    public function testRequiresPasswordToHaveMaxLength(): void
    {
        Livewire::test(Create::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('role', 'admin')
            ->set('password', 'Password123!Password123!')
            ->set('password_confirmation', 'Password123!Password123!')
            ->call('store')
            ->assertHasErrors(['password']);
    }
    /**
     * Test that user creation requires the password to match a regex pattern.
     *
     * This test checks if creating a user requires the password to match a regex pattern.
     * It sets a password that does not match the pattern and validates that the 'password' field has validation errors.
     *
     * @return void
     */
    public function testRequiresPasswordToMatchRegexPattern(): void
    {
        Livewire::test(Create::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('role', 'admin')
            ->set('password', 'password123!')
            ->set('password_confirmation', 'password123!')
            ->call('store')
            ->assertHasErrors(['password']);
    }
}
