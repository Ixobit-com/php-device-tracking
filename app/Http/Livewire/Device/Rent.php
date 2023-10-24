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

class Rent extends Component
{
    use ComponentHelperTrait, NotificationTrait;

    public int $deviceId = 0;

    /**
     * Attach user to device.
     */
    public function rent(): void
    {
        $device = Device::find($this->deviceId);
        $device->update(
            [
                'user_id' => auth()->user()->id,
            ]
        );
        $this->sendNotification('Successfully rented device '.$device->name, 'success');
        $this->emit('deviceRented');
        $this->closeModal();
    }

    /**
     * Render view with params.
     */
    public function render(): View|Application|Factory|ApplicationAlias
    {
        $device = Device::find($this->deviceId);

        return view('livewire.device.rent', [
            'device' => $device,
            'types' => Device::TYPES,
            'statuses' => Device::STATUSES,
        ]);
    }
}
