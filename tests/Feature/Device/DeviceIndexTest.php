<?php

namespace Tests\Feature\Device;

use App\Http\Livewire\Device\Index;
use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeviceIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test shows if no devices found - "no devices found" message
     *
     * @return void
     */
    public function testShowsEmptyDeviceList(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Index::class)
            ->set('perPage', 10)
            ->call('render')
            ->assertSee('No devices found');
    }

    /**
     * Test that device list is paginated correctly.
     *
     * @return void
     */
    public function testCanShowPaginatedDevices(): void
    {
        $user = User::factory()->create();
        Device::factory()->create(
            [
                'name'     => 'Device 1',
                'type'     => 1,
                'model'    => 'Device 1',
                'status'   => 1,
                'location' => 'on table',
                'user_id'  => null,
            ]);

        Livewire::actingAs($user)
            ->test(Index::class)
            ->set('perPage', 10)
            ->call('render')
            ->assertSee('Device 1');
    }


    /**
     * Test shows that search works correctly
     *
     * @return void
     */
    public function testCanSearchDevicesByName(): void
    {
        $user = User::factory()->create();
        Device::factory()->create(
            [
                'name'     => 'Device 1',
                'type'     => 1,
                'model'    => 'Device 1',
                'status'   => 1,
                'location' => 'on table',
                'user_id'  => null,
            ]);

        Device::factory()->create(
            [
                'name'     => 'Device 2',
                'type'     => 1,
                'model'    => 'Device 2',
                'status'   => 1,
                'location' => 'on table',
                'user_id'  => null,
            ]);

        Livewire::actingAs($user)
            ->test(Index::class)
            ->set('perPage', 10)
            ->set('search', 'Device 1')
            ->call('render')
            ->assertSee('Device 1')
            ->assertDontSee('Device 2');
    }

    /**
     * Test shows that filter by type works correctly
     *
     * @return void
     */
    public function testCanFilterDevicesByType(): void
    {
        $user = User::factory()->create();
        Device::factory()->create(
            [
                'name'     => 'Device 3',
                'type'     => 1,
                'model'    => 'Device 3',
                'status'   => 1,
                'location' => 'on table',
                'user_id'  => null,
            ]);

        Device::factory()->create(
            [
                'name'     => 'Device 4',
                'type'     => 2,
                'model'    => 'Device 4',
                'status'   => 1,
                'location' => 'on table',
                'user_id'  => null,
            ]);

        Livewire::actingAs($user)
            ->test(Index::class)
            ->set('perPage', 10)
            ->set('type', 1)
            ->call('render')
            ->assertSee('Device 3')
            ->assertDontSee('Device 4');
    }

    /**
     * Test shows that filter by status works correctly
     *
     * @return void
     */
    public function testCanFilterDevicesByStatus(): void
    {
        $user = User::factory()->create();
        Device::factory()->create(
            [
                'name'     => 'Device 5',
                'type'     => 1,
                'model'    => 'Device 5',
                'status'   => 1,
                'location' => 'on table',
                'user_id'  => null,
            ]);

        Device::factory()->create(
            [
                'name'     => 'Device 6',
                'type'     => 1,
                'model'    => 'Device 6',
                'status'   => 3,
                'location' => 'on table',
                'user_id'  => null,
            ]);

        Livewire::actingAs($user)
            ->test(Index::class)
            ->set('perPage', 10)
            ->set('status', 1)
            ->call('render')
            ->assertSee('Device 5')
            ->assertDontSee('Device 6');
    }

}
