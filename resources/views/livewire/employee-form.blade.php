

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="contact_number" class="block text-gray-700">Contact Number</label>
            <input type="text" id="contact_number" wire:model="contact_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('contact_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" id="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="date_of_birth" class="block text-gray-700">Date of Birth</label>
            <input type="date" id="date_of_birth" wire:model="date_of_birth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700">Address</label>
            <input type="text" id="address" wire:model="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="employee_register_number" class="block text-gray-700">Employee Register Number</label>
            <input type="text" id="employee_register_number" wire:model="employee_register_number" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Submit</button>
       
        <button wire:click="redirectToListEmployee" class="w-full bg-gray-500 text-white py-2 rounded-md hover:bg-gray-600 mt-2">Cancel</button>
    </form>
</div>
