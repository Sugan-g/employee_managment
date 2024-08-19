@props(['show' => false])

<div x-data="{ show: @entangle($attributes->wire('model')) }" x-show="show" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
    <div class="bg-white p-6 rounded shadow-lg">
        <div class="text-lg font-semibold mb-4">
            {{ $title }}
        </div>
        <div class="mb-4">
            {{ $content }}
        </div>
        <div class="flex justify-end space-x-4">
            {{ $footer }}
        </div>
    </div>
</div>