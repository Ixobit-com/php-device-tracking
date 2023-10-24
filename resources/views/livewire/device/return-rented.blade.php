<div>
    <button wire:click="openModal"
            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md"
            type="button">
        Return
    </button>

    @if($showModal)
        <div
            class="fixed top-0 left-0 right-0 z-40 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex items-center justify-center">
            <div wire:click="closeModal(false)"
                 class="fixed top-0 left-0 right-0 bottom-0 bg-gray-800 opacity-50"></div>
            <div class="relative w-full max-w-md max-h-full">

                <div class="bg-gray-200 rounded-lg shadow-lg p-8">
                    <h3 class="text-lg font-medium text-gray-800">Device Details</h3>
                    <p class="text-sm text-gray-500">Name: {{ $device->name }}</p>
                    <p class="text-sm text-gray-500">Type: {{ $types[$device->type] }}</p>
                    <p class="text-sm text-gray-500">Model: {{ $device->model }}</p>
                    <p class="text-sm text-gray-500">Status: {{ $statuses[$device->status] }}</p>

                    <div class="my-4">
                        <label for="location" class="text-sm text-gray-500">Location</label>
                        <input wire:model.defer="location" type="text" id="location" placeholder="Enter new location"
                               class="@error('location') border-red-500 @enderror mt-1 block w-full bg-gray-300 text-gray-700 border border-gray-300 rounded-md py-3 px-4 leading-tight focus:outline-none focus:border-gray-500">
                        @error('location') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <button wire:click="returnRented" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md">Return
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
