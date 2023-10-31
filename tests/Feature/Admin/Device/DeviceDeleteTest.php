<?php

namespace Tests\Feature\Admin\Device;

use App\Http\Livewire\Admin\Device\Delete;
use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeviceDeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an admin user can delete a device.
     *
     * @return void
     */
    public function testCanDeleteDevice(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $device = Device::factory()->create();

        Livewire::actingAs($admin)
            ->test(Delete::class, ['deviceId' => $device->id])
            ->call('delete');

        $this->assertDatabaseMissing('devices', ['id' => $device->id]);
    }

}
