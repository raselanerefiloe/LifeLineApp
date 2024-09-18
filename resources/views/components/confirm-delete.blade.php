<div x-data="{ open: false, loading: false }">
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
            <div class="flex justify-end gap-3">
                <!-- Cancel Button -->
                <button @click="open = false" :disabled="loading" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-md hover:bg-gray-400 text-sm font-medium" :class="{ 'opacity-50 cursor-not-allowed': loading }">Cancel</button>

                <!-- Delete Form -->
                <form method="POST" action="{{ $action }}" class="ml-3" @submit.prevent="loading = true; $el.submit();">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600 text-sm font-medium" :disabled="loading" :class="{ 'opacity-50 cursor-not-allowed': loading }">
                        <!-- Loading Spinner and Text -->
                        <div class="flex items-center">
                            <template x-if="loading">
                                <svg class="animate-spin h-5 w-5 mr-3 -ml-1 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v2a6 6 0 00-6 6h2zm6-8a8 8 0 018 8h-2a6 6 0 00-6-6V4z"></path>
                                </svg>
                            </template>
                            <template x-if="!loading">
                                <span>Delete</span>
                            </template>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
