<div>
    <form wire:submit.prevent="login" method="post">
        <div class="py-2">
            <input wire:model.lazy="email" type="text" id="email" name="email" placeholder="Email"
                   class="@error('email') border-red-500 @enderror w-full px-3 py-2 placeholder-gray-400 border
                   border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="py-2">
            <input wire:model.lazy="password" type="password" id="password" name="password" placeholder="Password"
                   class="@error('password') border-red-500 @enderror w-full px-3 py-2 placeholder-gray-400 border
                   border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button
            class="float-right py-2 px-4 bg-violet-500 text-white font-semibold rounded-lg shadow-md hover:bg-violet-700
            focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"
            type="submit">Login
        </button>
    </form>
</div>
