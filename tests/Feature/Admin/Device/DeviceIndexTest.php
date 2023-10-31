<?php

namespace Tests\Feature\Admin\Device;

use App\Http\Livewire\Admin\Device\Index;
use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeviceIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that device list is paginated correctly.
     *
     * This test ensures that the device list is correctly paginated when
     * the 'perPage' parameter is set to 10. It checks if the first device's
     * name is visible, the 10th device's name is visible, and the 11th device's
     * name is not visible.
     *
     * @return void
     */
    public function testPaginatesDeviceList(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $devices = Device::factory(15)->create();
        Livewire::actingAs($admin)
            ->test(Index::class)
            ->set('perPage', 10)
            ->call('render')
            ->assertSee($devices->first()->name)
            ->assertSee($devices->get(9)->name)
            ->assertDontSee($devices->get(10)->name)
        ;
    }

    /**
     * Test searching for a device by its name.
     *
     * This test verifies that searching for a device by its name yields the
     * expected result. It sets the 'search' parameter to 'Test Device' and
     * checks if 'Test Device' is visible in the rendered component.
     *
     * @return void
     */
    public function testSearchDeviceByName(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Device::factory()->create(['name' => 'Test Device']);
        Livewire::actingAs($admin)
            ->test(Index::class)
            ->set('search', 'Test Device')
            ->call('render')
            ->assertSee('Test Device');
    }

    /**
     * Test filtering devices by type and status.
     *
     * This test verifies that devices can be filtered by type and status. It sets
     * the 'type' and 'status' parameters and checks if a device with the specified
     * type and status is visible in the rendered component.
     *
     * @return void
     */
    public function testFilterDevicesByTypeAndStatus(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Device::factory()->create(['name' => 'Test Device 1', 'type' => 1, 'status' => 1]);
        Livewire::actingAs($admin)
            ->test(Index::class)
            ->set('type', 1)
            ->set('status', 1)
            ->call('render')
            ->assertSee('Test Device 1');
    }
}
