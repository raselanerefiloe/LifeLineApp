<!-- resources/views/components/confirm-delete.blade.php -->
<div x-data="{ open: false }">
    <!-- Trigger Button -->
    <button @click="open = true" type="button" {{ $attributes->merge(['class' => 'text-red-600 hover:text-red-900']) }}>
        {{ $triggerText }}
    </button>

    <!-- Modal Background -->
    <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- Modal -->
    <div x-show="open" @click.away="open = false" class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
            <h3 class="text-lg font-semibold mb-4">{{ $title }}</h3>
            <p class="mb-4">{{ $message }}</p>
            <div class="flex justify-end">
                <button @click="open = false" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                <form method="POST" action="{{ $action }}" class="ml-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
