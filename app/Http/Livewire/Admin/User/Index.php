<?php

namespace App\Http\Livewire\Admin\User;

use App\Http\Traits\SortableTrait;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, SortableTrait;

    public int    $perPage = 10;

    public string $search = '';

    public array  $perPageOptions = [10, 25, 50, 100];

    protected $listeners = ['userCreated' => '$refresh', 'userUpdated' => '$refresh'];

    /**
     * Reset pagination page on updating search.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Render view.
     */
    public function render(): View|Application|Factory|ApplicationAlias
    {
        return view('livewire.admin.user.index', [
            'users' => User::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage),
            'perPageOptions' => $this->perPageOptions,
        ]);
    }
}
