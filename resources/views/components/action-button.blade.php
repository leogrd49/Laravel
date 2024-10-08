@if($type === 'edit')
    <a href="{{ $href }}" class="text-red-500 hover:text-red-700 mr-4 mb-3.5">
        <box-icon name='edit' type='solid' color='#FF0000' class="mt-3.5"></box-icon>
    </a>
@elseif($type === 'delete')
    <form action="{{ $href }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold"
                onclick="confirmDelete(event)">
            <box-icon name='trash' color='#FF0000'></box-icon>
        </button>
    </form>
@endif
