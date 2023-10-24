<?php

namespace App\Http\Livewire\Admin\Device;

use App\Models\Device;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class Create extends AbstractDeviceActions
{
    /**
     * Create new device.
     */
    public function store(): void
    {
        $validated = $this->validate();
        if (User::find($validated['user_id'])?->banned_at) {
            $this->sendNotification('Unable to assign device to banned user', 'error');

            return;
        }

        Device::create($validated);
        $this->sendNotification('Successfully created device', 'success');
        $this->emit('deviceCreated');
        $this->closeModal();
    }

    /**
     * Render view.
     */
    public function render(): View|Application|Factory|ApplicationAlias
    {
        return view('livewire.admin.device.create', [
            'users' => User::search($this->search)->paginate(User::PAGINATION_ON_DEVICE_ACTIONS),
        ]);
    }
}
