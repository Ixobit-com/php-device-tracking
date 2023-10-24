<?php

namespace App\Http\Livewire\Device;

use App\Http\Traits\ComponentHelperTrait;
use App\Http\Traits\NotificationTrait;
use App\Models\Device;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ReturnRented extends Component
{
    use ComponentHelperTrait, NotificationTrait;

    public int $deviceId = 0;

    public string $location = '';

    /**
     * Detach user from device with new location.
     */
    public function returnRented(): void
    {
        $validated = $this->validate(
            [
                'location' => ['required', 'string', 'max:255'],
            ]
        );
        $validated['user_id'] = null;
        $device = Device::find($this->deviceId);
        $device->update(
            $validated
        );
        $this->sendNotification('Successfully returned device '.$device->name, 'success');
        $this->emit('deviceRented');
        $this->closeModal();
    }

    /**
     * Render view with params.
     */
    public function render(): View|Application|Factory|ApplicationAlias
    {
        $device = Device::find($this->deviceId);

        return view('livewire.device.return-rented', [
            'device' => $device,
            'types' => Device::TYPES,
            'statuses' => Device::STATUSES,
        ]);
    }
}
