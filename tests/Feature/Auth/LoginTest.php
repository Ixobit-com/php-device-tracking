<?php

namespace Tests\Feature\Auth;

use App\Http\Livewire\Auth\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test validation for email and password
     *
     * @return void
     */
    public function testLoginFormValidation(): void
    {
        User::factory()->create();

        Livewire::test(Login::class)
            ->set('email', 'invalid_email')
            ->set('password', 'short')
            ->call('login')
            ->assertHasErrors(['email', 'password']);
    }

    /**
     * Test that user can successfully log in
     *
     * @return void
     */
    public function testSuccessfulLogin(): void
    {
        User::factory()->create(
            [
                'email'    => 'valid@example.com',
                'password' => Hash::make('valid_password'),
            ]);

        Livewire::test(Login::class)
            ->set('email', 'valid@example.com')
            ->set('password', 'valid_password')
            ->call('login')
            ->assertRedirect(route('main'));
    }
}

