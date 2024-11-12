@extends('layout.template')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <form action="{{ route('posts.store') }}" method="POST"
        class="bg-white p-6 rounded-lg shadow-lg border border-slate-200 w-96">
        @csrf

        <h2 class="text-2xl font-semibold mb-4">Create a post</h2>
        <div class="flex flex-col mb-2">
            <span class="mb-1">Title</span>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="border border-slate-200 py-3 px-5 rounded-lg focus:outline-red-400">
            @if ($errors->has('title'))
                <span class="text-red-400">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="flex flex-col mb-4">
            <span class="mb-1">Content</span>
            <textarea type="text" name="content" id="content" rows="4"
                class="border border-slate-200 py-3 px-5 rounded-lg focus:outline-red-400">{{ old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="text-red-400">{{ $errors->first('content') }}</span>
            @endif
        </div>

        <div class="flex flex-col mb-4">
            <label for="categories" class="mb-1">Categories</label>
            <select name="categories[]" id="categories" multiple class="border border-gray-300 rounded-md">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('categories'))
                <span class="text-red-400">{{ $errors->first('categories') }}</span>
            @endif
        </div>

        <div class="flex justify-end items-center gap-10">
            <button type="submit"
                class="bg-red-400 text-white hover:bg-red-300 hover:text-black duration-300 py-3 px-5 rounded-lg text-end">Create</button>
        </div>
    </form>
</div>
@endsection