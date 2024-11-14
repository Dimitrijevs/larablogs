@extends('layout.template')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <form id="editPostForm" action="{{ route('posts.update', $post->id) }}" method="POST"
            class="bg-white p-6 rounded-lg shadow-lg border border-slate-200 w-96">
            @csrf
            @method('PUT')

            <h2 class="text-2xl font-semibold mb-4">Edit a post</h2>

            <div class="flex flex-col mb-2">
                <label for="title" class="mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}"
                    class="border border-slate-200 py-3 px-5 rounded-lg focus:outline-red-400">
                <span id="titleError" class="text-red-400"></span>
                @if ($errors->has('title'))
                    <span class="text-red-400">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <div class="flex flex-col mb-4">
                <label for="content" class="mb-1">Content</label>
                <textarea name="content" id="content" rows="4"
                    class="border border-slate-200 py-3 px-5 rounded-lg focus:outline-red-400">{{ $post->content }}</textarea>
                <span id="contentError" class="text-red-400"></span>
                @if ($errors->has('content'))
                    <span class="text-red-400">{{ $errors->first('content') }}</span>
                @endif
            </div>

            <div class="flex flex-col mb-4">
                <label class="mb-1">Categories</label>
                <div id="categories" class="flex flex-wrap gap-4">
                    @foreach ($categories as $category)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                class="form-checkbox h-5 w-5 text-red-600"
                                {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <span class="ml-2">{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
                <span id="categoriesError" class="text-red-400"></span>
                @if ($errors->has('categories'))
                    <span class="text-red-400">{{ $errors->first('categories') }}</span>
                @endif
            </div>

            <div class="flex justify-end items-center gap-10">
                <button type="submit"
                    class="bg-red-400 text-white hover:bg-red-300 hover:text-black duration-300 py-3 px-5 rounded-lg">Save</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function validateTitle() {
            const titleField = document.getElementById('title');
            const titleError = document.getElementById('titleError');
            const title = titleField.value.trim();
            let isValid = true;

            titleError.innerText = '';

            if (!title) {
                titleError.innerText = 'Title is required.';
                isValid = false;
            } else if (title.length < 3) {
                titleError.innerText = 'Title must be at least 3 characters.';
                isValid = false;
            } else if (title.length > 255) {
                titleError.innerText = 'Title cannot exceed 255 characters.';
                isValid = false;
            }

            return isValid;
        }

        function validateContent() {
            const contentField = document.getElementById('content');
            const contentError = document.getElementById('contentError');
            const content = contentField.value.trim();
            let isValid = true;

            contentError.innerText = '';

            if (!content) {
                contentError.innerText = 'Content is required.';
                isValid = false;
            } else if (content.length < 8) {
                contentError.innerText = 'Content must be at least 8 characters.';
                isValid = false;
            }

            return isValid;
        }

        function validateCategories() {
            const categoriesField = document.getElementById('categories');
            const categoriesError = document.getElementById('categoriesError');
            const selectedOptions = Array.from(categoriesField.selectedOptions);
            let isValid = true;

            categoriesError.innerText = '';

            if (selectedOptions.length === 0) {
                categoriesError.innerText = 'Please select at least one category.';
                isValid = false;
            }

            return isValid;
        }

        document.getElementById('editPostForm').addEventListener('submit', function(event) {
            let isValid = true;

            if (!validateTitle()) isValid = false;
            if (!validateContent()) isValid = false;
            if (!validateCategories()) isValid = false;

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
@endpush
