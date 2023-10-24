<?php

namespace App\Http\Livewire\Admin\Device;

use App\Http\Traits\ComponentHelperTrait;
use App\Http\Traits\NotificationTrait;
use App\Models\Device;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

abstract class AbstractDeviceActions extends Component
{
    use NotificationTrait, ComponentHelperTrait, WithPagination;

    public string $name = '';

    public int $type = 0;

    public string $model = '';

    public int $status = 0;

    public string $location = '';

    public ?string $user_id = null;

    public array $types = [];

    public array $statuses = [];

    public string $search = '';

    protected array $rules;

    /**
     * Validation rules for creating\updating devices.
     */
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->types = Device::TYPES;
        $this->statuses = Device::STATUSES;
        $this->rules = [
            'name' => ['required', 'string', 'max:255'],
            'type' => [
                'required',
                'integer',
                Rule::in(array_keys(Device::TYPES)),
            ],
            'model' => ['required', 'string', 'max:255'],
            'status' => [
                'required',
                'integer',
                Rule::in(array_keys(Device::STATUSES)),
            ],
            'location' => ['required', 'string', 'max:255'],
            'user_id' => [
                'nullable',
                Rule::exists('users', 'id'),
            ],
        ];
    }

    /**
     * Reset pagination page on updating search.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }
}
