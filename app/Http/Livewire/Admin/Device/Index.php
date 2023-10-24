<?php

namespace App\Http\Livewire\Admin\Device;

use App\Http\Traits\SortableTrait;
use App\Models\Device;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, SortableTrait;

    public int     $perPage = 10;

    public string  $search = '';

    public ?string $type = null;

    public ?string $status = null;

    protected $listeners = ['deviceCreated' => '$refresh', 'deviceUpdated' => '$refresh', 'deviceDeleted' => '$refresh'];

    /**
     * Render view.
     */
    public function render(): View|Application|Factory|ApplicationAlias
    {
        $type = ($this->type === '') ? null : $this->type;
        $status = ($this->status === '') ? null : $this->status;

        return view('livewire.admin.device.index', [
            'devices' => Device::search($this->search, $type, $status)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage),
            'types' => Device::TYPES,
            'statuses' => Device::STATUSES,
        ]);
    }
}
