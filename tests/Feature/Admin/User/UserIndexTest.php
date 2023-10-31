<?php

namespace Tests\Feature\Admin\User;

use App\Http\Livewire\Admin\User\Index;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the user list is paginated and displayed correctly.
     *
     * @return void
     */
    public function testCanShowPaginatedUsers(): void
    {
        $admin = User::factory()->create(
            [
                'name'  => 'admin',
                'email' => 'admin@admin.com',
                'role'  => 'admin',
            ]);

        User::factory()->create(
            [
                'name'  => 'John Doe',
                'email' => 'johndoe@example.com',
            ]);

        Livewire::actingAs($admin)
            ->test(Index::class)
            ->set('perPage', 10)
            ->call('render')
            ->assertSee('John Doe')
            ->assertSee('johndoe@example.com');
    }
}
