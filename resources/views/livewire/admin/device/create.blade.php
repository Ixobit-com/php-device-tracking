<div>
    <button wire:click="openModal"
            class="mx-1 my-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
        Create Device
    </button>

    @if($showModal)
        <div
            class="fixed top-0 left-0 right-0 z-40 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex items-center justify-center">
            <div wire:click="closeModal" class="fixed top-0 left-0 right-0 bottom-0 bg-gray-800 opacity-50"></div>
            <div class="relative w-full max-w-md max-h-full">

                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button wire:click="closeModal" type="button"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                            data-modal-hide="create-user-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Create new device:</h3>
                        <form class="space-y-6">
                            <div>
                                <label for="name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                                <input wire:model.defer="name" type="text" name="name" id="name"
                                       class="@error('name') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                       placeholder="iPhone 14 pink">
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="type"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type:</label>
                                <select wire:model.defer="type" id="type"
                                        class="@error('type') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose type</option>
                                    @foreach($types as $key => $type)
                                        <option value="{{ $key }}">{{ ucfirst($type) }}</option>
                                    @endforeach
                                </select>
                                @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="model"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Model:</label>
                                <input wire:model.defer="model" type="text" name="model" id="model"
                                       class="@error('model') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                       placeholder="iPhone 14">
                                @error('model') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="status"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status:</label>
                                <select wire:model.defer="status" id="status"
                                        class="@error('status') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose status</option>
                                    @foreach($statuses as $key => $status)
                                        <option value="{{ $key }}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="location"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location:</label>
                                <input wire:model.defer="location" type="text" name="location" id="location"
                                       class="@error('location') border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                       placeholder="Bishkek 1 floor">
                                @error('location') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input wire:model="search" type="text" placeholder="Search users..."
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/6 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <select wire:model="user_id"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-2/6 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Choose user</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{ $users->links() }}

                            <button type="button" wire:click.prevent="store"
                                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
