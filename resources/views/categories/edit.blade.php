@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-4">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Title</label>
                            <input type="name" name="name" id="name" placeholder="your name"
                                class="bg-gray-100 border-2  w-full p-4 rounded-lg " value="{{ $category->name }}">
                            @error('name ')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                </div>
                <div class="mb-4">
                    <label for="category"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                    <select id="parent_id" name="parent_id"class="bg-gray-100 border-2 w-full p-4 rounded-lg">
                        <option value="{{ $category->id }}" selected disabled>{{ $category->name }}</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection
