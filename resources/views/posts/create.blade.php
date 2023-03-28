@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Title</label>
                            <input type="title" name="title" id="title" placeholder="your title"
                                class="bg-gray-100 border-2  w-full p-4 rounded-lg " value="">
                            @error('title')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <label for="files" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Select
                                files</label>
                            <input id="file" type="file" name="image"
                                class="bg-gray-100 border-2 w-full p-4 rounded-lg" value="" multiple>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                </div>
                <div class="mb-4">
                    <label for="category"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                    <select id="category" name="category_id"class="bg-gray-100 border-2 w-full p-4 rounded-lg">
                        <option value="" selected disabled>choose category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="content">content</label>
                    <textarea name="content" id="content" cols="10" rows="4"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('content') border-red-500 @enderror"
                        placeholder="Post something">{{ old('content') ? nl2br(e(old('content'))) : '' }}
                    </textarea>
                    @error('content')
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
