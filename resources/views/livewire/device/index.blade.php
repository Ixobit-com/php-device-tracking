<div class="mt-2">
    <div class="flex pb-10">
        <div class="w-3/4 pr-4">
            <div class="mb-4">
                <label class="block mb-2">
                    <span class="text-gray-700">Search device</span>
                    <input wire:model.debounce.300ms="search" type="text"
                           class="mt-1 block w-full bg-white border border-gray-300 rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-blue-500">
                </label>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
                @foreach($devices as $device)
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-800">Name: {{ $device->name }}</h3>
                            <p class="text-sm text-gray-500">Type: {{ $types[$device->type] }}</p>
                            <p class="text-sm text-gray-500">Model: {{ $device->model }}</p>
                            <p class="text-sm text-gray-500">Status: {{ $statuses[$device->status] }}</p>
                            <p class="text-sm text-gray-500">Location: {{ $device->location }}</p>
                            <p class="text-sm text-gray-500">Renter: {{ $device->user?->email ?? "no" }}</p>
                            <div class="mt-4">
                                @if (!$device->user)
                                    <livewire:device.rent :deviceId="$device->id"
                                                          :key="time().$device->id"/>
                                @else
                                    @if ($device->user?->email === auth()->user()->email)
                                        <livewire:device.return-rented :deviceId="$device->id"
                                                                       :key="time().$device->id"/>
                                    @else
                                        <div class="flex">
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md" disabled>Rent
                                            </button>
                                            <div class="mt-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $devices->links('livewire::tailwind') }}
        </div>
        <div class="w-1/4">
            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="mb-4">
                    <label class="block mb-2">
                        <span class="text-gray-700">Type</span>
                        <select wire:model="type"
                                class="mt-1 block w-full bg-white border border-gray-300 rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-blue-500">
                            <option value="">All</option>
                            @foreach($types as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">
                        <span class="text-gray-700">Status</span>
                        <select wire:model="status"
                                class="mt-1 block w-full bg-white border border-gray-300 rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-blue-500">
                            <option value="">All</option>
                            @foreach($statuses as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="mb-4">
                    <label class="block mb-2">
                        <span class="text-gray-700">Per page</span>
                        <select wire:model="perPage"
                                class="mt-1 block w-full bg-white border border-gray-300 rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-blue-500">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                    </label>
                </div>
                <div class="mb-4">
                    <div class="flex items-center mr-4">
                        <input wire:model="onlyMine" checked id="green-checkbox" type="checkbox" value=""
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="green-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Only
                            mine</label>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
