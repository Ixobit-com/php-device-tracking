<?php

namespace App\Http\Livewire\Device;

use App\Http\Traits\SortableTrait;
use App\Models\Device;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;
use Rap2hpoutre\FastExcel\FastExcel;

class Index extends Component
{
    use WithPagination, SortableTrait;

    public int  $perPage = 9;

    public bool $onlyMine = false;

    public string  $search = '';

    public ?string $type = null;

    public ?string $status = null;

    protected $listeners = ['deviceRented' => '$refresh', 'deviceReturned' => '$refresh'];

    /**
     * Reset pagination page on updating search.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Reset pagination page on updating only mine variable.
     */
    public function updatingOnlyMine(): void
    {
        $this->resetPage();
    }

    /**
     * Render view with params.
     */
    public function render(): View|Application|Factory|ApplicationAlias
    {
        $type = ($this->type === '') ? null : $this->type;
        $status = ($this->status === '') ? null : $this->status;

        return view('livewire.device.index', [
            'devices' => Device::search($this->search, $type, $status, $this->onlyMine)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage),
            'types' => Device::TYPES,
            'statuses' => Device::STATUSES,
        ]);
    }

    public function test()
    {
        $zxc = new FastExcel();
        \fastexcel();
    }
}
