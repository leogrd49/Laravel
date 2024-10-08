<li class="bg-red-50 p-4 rounded-lg shadow flex justify-between items-center">
    <div>
        <p class="text-xl font-semibold">{{ __('absencenumber') }}: <span class="text-red-700">{{ $absence->id }}</span></p>
        <p class="text-xl font-semibold">{{ __('absencereason') }}: <span class="text-red-700">{{ $absence->motif ? $absence->motif->libelle : __('na') }}</span></p>
        <p class="text-xl font-semibold">{{ __('absenceuser') }}: <span class="text-red-700">{{ $absence->user ? $absence->user->prenom . ' ' . $absence->user->nom : __('na') }}</span></p>
        <p class="text-xl font-semibold">{{ __('absencestatus') }}: <span class="text-red-700">{{ $absence->status }}</span></p>
    </div>
    <div class="flex items-center">
        {{ $slot }}
    </div>
</li>
