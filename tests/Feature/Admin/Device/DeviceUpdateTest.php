<?php

namespace Tests\Feature\Admin\Device;

use App\Http\Livewire\Admin\Device\Update;
use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeviceUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an admin user can update a device.
     *
     * This test checks if an admin user can successfully update the details of a device.
     * It creates an admin user, a device, and sets new data for the device. Then, it opens
     * the modal, updates the device with the new data, and asserts that the updated data
     * is present in the database.
     *
     * @return void
     */
    public function testCanUpdateDevice(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $device = Device::factory()->create();
        $newUserData = [
            'name' => 'Updated Device',
            'type' => 2,
            'model' => 'Model B',
            'status' => 1,
            'location' => 'Warehouse',
            'user_id' => null,
        ];

        Livewire::actingAs($admin)
            ->test(Update::class, ['deviceId' => $device->id])
            ->call('openModal')
            ->set('name', $newUserData['name'])
            ->set('type', $newUserData['type'])
            ->set('model', $newUserData['model'])
            ->set('status', $newUserData['status'])
            ->set('location', $newUserData['location'])
            ->set('user_id', $newUserData['user_id'])
            ->call('update');

        $this->assertDatabaseHas('devices', $newUserData);
    }

    /**
     * Test that it's not possible to assign a device to a banned user during update.
     *
     * This test checks if an admin user cannot assign a device to a banned user during the update.
     * It creates an admin user, a banned user, and a device. Then, it attempts to update the device
     * with the banned user as the new user, and asserts that the device remains unchanged in the database.
     *
     * @return void
     */
    public function testCannotAssignDeviceToBannedUserOnUpdate(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $bannedUser = User::factory()->create(['banned_at' => now()]);
        $device = Device::factory()->create();

        Livewire::actingAs($admin)
            ->test(Update::class, ['deviceId' => $device->id])
            ->call('openModal')
            ->set('user_id', $bannedUser->id)
            ->call('update')
            ;

        $this->assertDatabaseMissing('devices', ['name' => $device->name, 'model' => $device->model, 'user_id' => $bannedUser->id]);
    }

    /**
     * Test validation for an existing user during device update.
     *
     * This test verifies that a validation error occurs when an admin user attempts to update
     * a device with a non-existing user. It creates an admin user, a device, and attempts to update
     * the device with a user ID of 0. It then asserts that the 'user_id' field has validation errors.
     *
     * @return void
     */
    public function testValidationExistingUserOnUpdate(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $device = Device::factory()->create();
        Livewire::actingAs($admin)
            ->test(Update::class, ['deviceId' => $device->id])
            ->set('user_id', 0)
            ->call('update')
            ->assertHasErrors(['user_id']);
    }

}
