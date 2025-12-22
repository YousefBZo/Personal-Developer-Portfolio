@props([
</x-modal>
    </form>
        </div>
            </x-primary-button>
                </span>
                    Processing...
                    </svg>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <span x-show="submitting" class="flex items-center">
                <span x-show="!submitting">{{ $submitText }}</span>
            <x-primary-button x-bind:disabled="submitting">

            </x-secondary-button>
                {{ __('Cancel') }}
            <x-secondary-button x-on:click="$dispatch('close')">
        <div class="mt-6 flex justify-end gap-3">

        </div>
            {{ $slot }}
        <div class="space-y-4">

        </h2>
            {{ $title }}
        <h2 class="text-lg font-medium text-gray-900 mb-4">

        </template>
            @method('DELETE')
        <template x-if="method === 'DELETE'">
        </template>
            @method('PUT')
        <template x-if="method === 'PUT' || method === 'PATCH'">
        @csrf
    >
        class="p-6"
        @submit="submitting = true"
        enctype="multipart/form-data"
        method="POST"
        x-bind:action="action"
        }"
            action: '{{ $action }}'
            method: '{{ $method }}',
            submitting: false,
        x-data="{
    <form
<x-modal :name="$name" :maxWidth="$maxWidth" focusable>

])
    'method' => 'POST',
    'action' => '',
    'submitText' => 'Save',
    'maxWidth' => 'lg',
    'title' => 'Form',
    'name',

