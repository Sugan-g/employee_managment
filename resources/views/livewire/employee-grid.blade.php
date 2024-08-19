<!-- resources/views/livewire/employee-list.blade.php -->

<div >
    <div class="flex flex-row">
<div class="p-4">
    <input type="text" wire:model="search" placeholder="Search by name..." class="mb-4 px-4 py-2 border rounded">

</div>
<div class="p-5">
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="import">
        <div class="">
            <input type="file" wire:model="file" class="form-control w-2/4">
            @error('file') <span class="text-danger">{{ $message }}</span> @enderror

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">Import</button>
        </div>
        
    </form>
</div>



<div class="p-3">
    <button wire:click="exportPDF" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Export Employees to PDF</button>
</div>
<div class="p-3">
    <button wire:click="redirectToCreateEmployee" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Create Employee</button>
</div>
</div>



    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2">Name</th>
                <th class="py-2">Contact Number</th>
                <th class="py-2">Email</th>
                <th class="py-2">Date of Birth</th>
                <th class="py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td class="py-2 text-center">{{ $employee->name }}</td>
                    <td class="py-2 text-center">{{ $employee->contact_number }}</td>
                    <td class="py-2 text-center">{{ $employee->email }}</td>
                    <td class="py-2 text-center">{{ $employee->date_of_birth ?? $employee->date_of_birth->format('Y-m-d')  }}</td>
                    <td class="py-2 text-center">
                         <button wire:click="editEmployee({{ $employee->id }})" class="bg-yellow-500 text-white px-4 py-2">Edit</button>
                        <button wire:click="handleConfirmDelete({{ $employee->id }})" class="bg-red-500 text-white px-4 py-2">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-confirmation-modal wire:model="showDeleteModal">
        <x-slot name="title">
            Confirm Deletion
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete this employee?
        </x-slot>

        <x-slot name="footer">
            <button wire:click="$set('showDeleteModal', false)" class="bg-gray-500 text-white px-4 py-2 ml-2">Cancel</button>
            <button wire:click="deleteEmployee" class="bg-red-500 text-white px-4 py-2 ml-2">Delete</button>
        </x-slot>
    </x-confirmation-modal>
</div>

