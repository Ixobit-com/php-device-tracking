<?php

namespace App\Http\Livewire\Admin\Device;

use App\Models\Device;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class Update extends AbstractDeviceActions
{
    public int $deviceId = 0;

    /**
     * Open modal for edit device, preview data from database.
     */
    public function openModal(): void
    {
        $this->showModal = true;

        $device = Device::find($this->deviceId);
        $this->name = $device->name;
        $this->type = $device->type;
        $this->model = $device->model;
        $this->status = $device->status;
        $this->location = $device->location;
        $this->user_id = $device->user?->id;
    }

    /**
     * Update device.
     */
    public function update(): void
    {
        $device = Device::find($this->deviceId);
        $validated = $this->validate();
        $validated['user_id'] = $validated['user_id'] ?: null;
        if (User::find($validated['user_id'])?->banned_at) {
            $this->sendNotification('Unable to assign device to banned user', 'error');

            return;
        }

        $device->update($validated);

        $this->sendNotification('Successfully updated device', 'success');
        $this->emit('deviceUpdated');
        $this->closeModal();
    }

    /**
     * Render view.
     */
    public function render(): View|Application|Factory|ApplicationAlias
    {
        return view('livewire.admin.device.update', [
            'users' => User::search($this->search)->paginate(User::PAGINATION_ON_DEVICE_ACTIONS),
        ]);
    }
}
