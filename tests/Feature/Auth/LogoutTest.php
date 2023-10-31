<?php

namespace Tests\Feature\Auth;

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that user can successfully log in and log out
     *
     * @return void
     */
    public function testSuccessfulLogout(): void
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

        Livewire::test(Logout::class)
            ->call('logout');

        $this->assertGuest();
    }
}
