<a {{ $attributes->merge(['class' => 'bg-red-300 rounded-lg border border-red-800 p-2 font-bold text-center text-red-800 hover:bg-red-400']) }}
    href="{{ $href }}">
     {{ $slot }}
 </a>
