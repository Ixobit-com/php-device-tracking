<div>
    <livewire:admin.user.create/>

    <div class="w-full flex pb-10">
        <div class="w-5/6 mx-1">
            <label> Search user
                <input wire:model.debounce.300ms="search" type="text"
                       class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       placeholder="Search users...">
            </label>
        </div>
        <div class="w-1/6 relative mx-1">
            <label for="grid-state">Per page</label><select wire:model="perPage"
                                                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                            id="grid-state">
                @foreach($perPageOptions as $option)
                    <option>{{ $option }}</option>
                @endforeach
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
                    <button wire:click="sortBy('email')" class="flex items-center space-x-1">
                        <span>Email</span>
                        {!! $this->getSortIcon('email') !!}
                    </button>
                </div>
            </th>
            <th class="px-4 py-2 text-center">
                <div class="flex items-center justify-center">
                    <button wire:click="sortBy('created_at')" class="flex items-center space-x-1">
                        <span>Created At</span>
                        {!! $this->getSortIcon('created_at') !!}
                    </button>
                </div>
            </th>
            <th class="px-4 py-2 text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="border px-4 py-2">{{ $user->id }}</td>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">{{ $user->created_at->diffForHumans() }}</td>
                <td class="border px-4 py-2">
                    <livewire:admin.user.update :userId="$user->id" :bannedAt="$user->banned_at"
                                                :key="time().$user->id"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $users->links('livewire::tailwind') }}

</div>
