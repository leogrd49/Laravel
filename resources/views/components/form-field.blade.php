<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $label }}</label>
    {{ $slot }}
    @error($name)
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>
