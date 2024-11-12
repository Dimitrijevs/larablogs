<form action="{{ route('posts.destroy', $id) }}" method="POST" class="me-2">
    @csrf
    @method('DELETE')
    
    <button type="submit">
        <x-tabler-trash class="text-red-400" />
    </button>
</form>