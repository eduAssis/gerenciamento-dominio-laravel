<div class="mb-4">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $label }}
    </label>
    <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $id }}"
            required="{{ $required }}"
            placeholder="{{ $placeholder }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
        @if($required) required @endif>
</div>
