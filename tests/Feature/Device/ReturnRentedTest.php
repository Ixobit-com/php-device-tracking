<?php

namespace Tests\Feature\Device;

use App\Http\Livewire\Device\ReturnRented;
use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ReturnRentedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that user can return device and on device user_id becomes null
     *
     * @return void
     */
    public function testCanReturnRentedDevice(): void
    {
        $user   = User::factory()->create();
        $device = Device::factory()->create(
            [
                'user_id' => $user->id,
            ]);

        Livewire::actingAs($user)
            ->test(ReturnRented::class, ['deviceId' => $device->id])
            ->set('location', 'New Location')
            ->call('returnRented');

        $this->assertDatabaseHas('devices', [
            'id'       => $device->id,
            'user_id'  => null,
            'location' => 'New Location',
        ]);
    }

    /**
     * Test validation on location fields required
     *
     * @return void
     */
    public function testValidatesLocationRequired(): void
    {
        $user   = User::factory()->create();
        $device = Device::factory()->create(
            [
                'user_id' => $user->id,
            ]);

        Livewire::actingAs($user)
            ->test(ReturnRented::class, ['deviceId' => $device->id])
            ->set('location', '')
            ->call('returnRented')
            ->assertHasErrors(['location' => 'required']);
    }

    /**
     * Test validation max length for location field
     *
     * @return void
     */
    public function testValidatesLocationMaxLength(): void
    {
        $user   = User::factory()->create();
        $device = Device::factory()->create(
            [
                'user_id' => $user->id,
            ]);

        Livewire::actingAs($user)
            ->test(ReturnRented::class, ['deviceId' => $device->id])
            ->set('location', str_repeat('a', 256))
            ->call('returnRented')
            ->assertHasErrors(['location' => 'max']);
    }
}
