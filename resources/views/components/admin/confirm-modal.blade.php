@props([
    'name',
    'title' => 'Confirm Action',
    'message' => 'Are you sure you want to perform this action?',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'danger' => true,
    'action' => '',
    'method' => 'DELETE',
])

<x-modal :name="$name" maxWidth="md" focusable>
    <form
        x-data="{
            submitting: false,
            action: '{{ $action }}'
        }"
        x-bind:action="action"
        method="POST"
        @submit="submitting = true"
        class="p-6"
    >
        @csrf
        @if($method === 'DELETE')
            @method('DELETE')
        @elseif($method === 'PUT' || $method === 'PATCH')
            @method('PUT')
        @endif

        <h2 class="text-lg font-medium text-gray-900">
            {{ $title }}
        </h2>

        <p class="mt-3 text-sm text-gray-600">
            {{ $message }}
        </p>

        {{ $slot }}

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ $cancelText }}
            </x-secondary-button>

            @if($danger)
                <x-danger-button x-bind:disabled="submitting">
                    <span x-show="!submitting">{{ $confirmText }}</span>
                    <span x-show="submitting" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing...
                    </span>
                </x-danger-button>
            @else
                <x-primary-button x-bind:disabled="submitting">
                    <span x-show="!submitting">{{ $confirmText }}</span>
                    <span x-show="submitting">Processing...</span>
                </x-primary-button>
            @endif
        </div>
    </form>
</x-modal>

