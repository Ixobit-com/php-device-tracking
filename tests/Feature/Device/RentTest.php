<?php

namespace Tests\Feature\Device;

use App\Http\Livewire\Device\Rent;
use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that user can attach device to his account
     *
     * @return void
     */
    public function testCanAttachUserToDevice(): void
    {
        $user   = User::factory()->create();
        $device = Device::factory()->create(
            [
                'user_id' => null,
            ]);

        Livewire::actingAs($user)
            ->test(Rent::class, ['deviceId' => $device->id])
            ->call('rent');

        $this->assertNotNull(Device::find($device->id)->user_id);
    }

    /**
     * Test on success rented device emitted event "deviceRented"
     *
     * @return void
     */
    public function testCanEmitDeviceRentedEventOnSuccessfulDeviceRental(): void
    {
        $user   = User::factory()->create();
        $device = Device::factory()->create(
            [
                'user_id' => null,
            ]);

        Livewire::actingAs($user)
            ->test(Rent::class, ['deviceId' => $device->id])
            ->call('rent')
            ->assertEmitted('deviceRented');
    }
}

