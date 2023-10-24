<div>
    <livewire:admin.device.create/>

    <div class="w-full flex pb-10">
        <div class="w-3/6 mx-1">
            <label> Search device
                <input wire:model.debounce.300ms="search" type="text"
                       class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       placeholder="Search devices...">
            </label>
        </div>
        <div class="w-1/6 relative mx-1">
            <label> Type
                <select wire:model="type"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">All</option>
                    @foreach($types as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute top-10 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                    </svg>
                </div>
            </label>
        </div>
        <div class="w-1/6 relative mx-1">
            <label> Status
                <select wire:model="status"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">All</option>
                    @foreach($statuses as $key => $status)
                        <option value="{{ $key }}">{{ $status }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute top-10 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                    </svg>
                </div>
            </label>
        </div>
        <div class="w-1/6 relative mx-1">
            <label for="grid-state">Per page</label><select wire:model="perPage"
                                                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                            id="grid-state">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <div class="pointer-events-none absolute top-10 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
            </div>
        </div>
    </div>
    <table class="table-auto w-full mb-6">
        <thead>
        <tr>
            <th class="px-4 py-2 text-center">
                <div class="flex items-center justify-center">
                    <button wire:click="sortBy('id')" class="flex items-center space-x-1">
                        <span>ID</span>
                        {!! $this->getSortIcon('id') !!}
                    </button>
                </div>
            </th>
            <th class="px-4 py-2 text-center">
                <div class="flex items-center justify-center">
                    <button wire:click="sortBy('name')" class="flex items-center space-x-1">
                        <span>Name</span>
                        {!! $this->getSortIcon('name') !!}
                    </button>
                </div>
            </th>
            <th class="px-4 py-2 text-center">
                <div class="flex items-center justify-center">
                    <button wire:click="sortBy('type')" class="flex items-center space-x-1">
                        <span>Type</span>
                        {!! $this->getSortIcon('type') !!}
                    </button>
                </div>
            </th>
            <th class="px-4 py-2 text-center">
                <div class="flex items-center justify-center">
                    <button wire:click="sortBy('model')" class="flex items-center space-x-1">
                        <span>Model</span>
                        {!! $this->getSortIcon('model') !!}
                    </button>
                </div>
            </th>
            <th class="px-4 py-2 text-center">
                <div class="flex items-center justify-center">
                    <button wire:click="sortBy('status')" class="flex items-center space-x-1">
                        <span>Status</span>
                        {!! $this->getSortIcon('status') !!}
                    </button>
                </div>
            </th>
            <th class="px-4 py-2 text-center">
                <div class="flex items-center justify-center">
                    <button wire:click="sortBy('location')" class="flex items-center space-x-1">
                        <span>Location</span>
                        {!! $this->getSortIcon('location') !!}
                    </button>
                </div>
            </th>
            <th class="px-4 py-2 text-center">
                <div class="flex items-center justify-center">
                    <button wire:click="sortBy('user_id')" class="flex items-center space-x-1">
                        <span>Renter</span>
                        {!! $this->getSortIcon('user_id') !!}
                    </button>
                </div>
            </th>
            <th class="px-4 py-2 text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($devices as $device)
            <tr>
                <td class="border px-4 py-2">{{ $device->id }}</td>
                <td class="border px-4 py-2">{{ $device->name }}</td>
                <td class="border px-4 py-2">{{ $types[$device->type] }}</td>
                <td class="border px-4 py-2">{{ $device->model }}</td>
                <td class="border px-4 py-2">{{ $statuses[$device->status] }}</td>
                <td class="border px-4 py-2">{{ $device->location }}</td>
                <td class="border px-4 py-2">{{ $device->user?->email }}</td>
                <td class="border px-4 py-2 flex">
                    <livewire:admin.device.update :deviceId="$device->id"
                                                  :key="time().$device->id"/>
                    <livewire:admin.device.delete :deviceId="$device->id"
                                                  :key="time().$device->id"
                    />
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $devices->links('livewire::tailwind') }}
</div>
