<form {{ $attributes->merge(['class' => 'w-full max-w-lg bg-white p-6 rounded-lg shadow-md']) }}>
    {{ $slot }}
</form>
