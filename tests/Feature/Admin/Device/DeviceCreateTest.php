<?php

namespace Tests\Feature\Admin\Device;

use App\Http\Livewire\Admin\Device\Create;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeviceCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an admin user can create a device.
     *
     * @return void
     */
    public function testCanCreateDevice(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();
        $name = fake()->unique()->word;
        Livewire::actingAs($admin)
            ->test(Create::class)
            ->set('name', $name)
            ->set('type', 1)
            ->set('model', $name)
            ->set('status', 1)
            ->set('location', 'Office')
            ->set('user_id', $user->id)
            ->call('store');

        $this->assertDatabaseHas('devices', ['name' => $name, 'user_id' => $user->id]);
    }

    /**
     * Test that an admin cannot assign a device to a banned user.
     *
     * @return void
     */
    public function testCannotAssignDeviceToBannedUser(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $bannedUser = User::factory()->create(['banned_at' => now()]);
        $name = fake()->unique()->word;
        Livewire::actingAs($admin)
            ->test(Create::class)
            ->set('name', $name)
            ->set('type', 1)
            ->set('model', $name)
            ->set('status', 1)
            ->set('location', 'Office')
            ->set('user_id', $bannedUser->id)
            ->call('store')
            ;
        $this->assertDatabaseMissing('devices', ['name' => $name, 'model' => $name, 'user_id' => $bannedUser->id]);
    }

    /**
     * Test validation for required fields when creating a device.
     *
     * @return void
     */
    public function testValidationRequiredFields(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Livewire::actingAs($admin)
            ->test(Create::class)
            ->call('store')
            ->assertHasErrors(['name', 'type', 'model', 'status', 'location']);
    }

    /**
     * Test validation for an invalid user ID when creating a device.
     *
     * @return void
     */
    public function testValidationExistingUser(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Livewire::actingAs($admin)
            ->test(Create::class)
            ->set('user_id', 0)
            ->call('store')
            ->assertHasErrors(['user_id']);
    }
}
