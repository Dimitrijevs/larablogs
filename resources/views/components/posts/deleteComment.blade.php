<form action="{{ route('comments.destroy', $id) }}" method="POST">
    @csrf
    @method('DELETE')
    
    <button type="submit">
        <x-tabler-trash class="text-red-400" />
    </button>
</form>