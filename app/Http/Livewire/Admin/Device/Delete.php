<?php

namespace App\Http\Livewire\Admin\Device;

use App\Http\Traits\ComponentHelperTrait;
use App\Http\Traits\NotificationTrait;
use App\Models\Device;
use Livewire\Component;

class Delete extends Component
{
    use ComponentHelperTrait, NotificationTrait;

    public int $deviceId = 0;

    /**
     * Delete device.
     */
    public function delete(): void
    {
        Device::find($this->deviceId)->delete();
        $this->emit('deviceDeleted');
        $this->closeModal();
    }
}
