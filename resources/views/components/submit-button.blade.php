<div class="flex items-center justify-center">
    <button type="submit" {{ $attributes->merge(['class' => 'bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline']) }}>
        {{ $slot }}
    </button>
</div>
