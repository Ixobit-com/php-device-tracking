<div>
    <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-md">Rent</button>

    @if($showModal)
        <div
            class="fixed top-0 left-0 right-0 z-40 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex items-center justify-center">
            <div wire:click="closeModal(false)"
                 class="fixed top-0 left-0 right-0 bottom-0 bg-blue-100 opacity-50"></div>

            <div class="relative w-full max-w-md max-h-full">
                <div class="bg-blue-200 rounded-lg shadow-lg p-8">
                    <h3 class="text-lg font-medium text-gray-800">Device Details</h3>
                    <p class="text-sm text-gray-500">Name: {{ $device->name }}</p>
                    <p class="text-sm text-gray-500">Type: {{ $types[$device->type] }}</p>
                    <p class="text-sm text-gray-500">Model: {{ $device->model }}</p>
                    <p class="text-sm text-gray-500">Status: {{ $statuses[$device->status] }}</p>
                    <p class="text-sm text-gray-500">Location: {{ $device->location }}</p>
                    <div class="mt-4">
                        <button wire:click="closeModal(false)" class="bg-red-500 text-white px-4 py-2 rounded-md">Close
                        </button>
                        <button wire:click="rent" class="bg-blue-500 text-white px-4 py-2 rounded-md">Rent</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
