<div class="p-6">
    @if ($employee)
        <form wire:submit.prevent="update">
            <div class="mb-4">
                <label for="name" class="block">Name (mandatory):</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full" required>
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="contact_number" class="block">Contact Number (mandatory):</label>
                <input type="text" id="contact_number" wire:model="contact_number" class="mt-1 block w-full" required>
                @error('contact_number') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block">Email (mandatory):</label>
                <input type="email" id="email" wire:model="email" class="mt-1 block w-full" required>
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="date_of_birth" class="block">Date of Birth (mandatory):</label>
                <input type="date" id="date_of_birth" wire:model="date_of_birth" class="mt-1 block w-full" required>
                @error('date_of_birth') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="block">Address (optional):</label>
                <textarea id="address" wire:model="address" class="mt-1 block w-full"></textarea>
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2">Update</button>
                <button wire:click="redirectToListEmployee" class="bg-gray-500 text-white px-4 py-2 ml-2">Cancel</button>
            </div>
        </form>

        @if (session()->has('message'))
            <div class="text-green-500">{{ session('message') }}</div>
        @endif
    @endif
</div>
