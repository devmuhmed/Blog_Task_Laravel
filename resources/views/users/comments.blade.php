@extends('layouts.app')
@section('style')
    <style>
        .w-5 {
            display: none;
        }

        .leading-5 {
            margin-bottom: 10px;
        }

        .plus {
            color: white;
            padding: 5px 15px;
            background-color: blue;
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-5">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ route('posts.index') }}" class="text-blue-500">Home</a>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    <a href="{{ route('profiles.posts', $user) }}" class="text-blue-500">posts of user</a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    <a href="{{ route('profiles.likes', $user) }}" class="text-blue-500">likes of user</a>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            @if ($comments->count())
                @foreach ($comments as $comment)
                    <div
                        class="mt-6 mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-4">
                        {{ $comment->user->name }}
                        <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                        <br>
                        {{ $comment->content }}
                        <span>{{ $comment->likes->count() }}{{ Str::plural('like', $comment->likes->count()) }}</span>

                        <div class="flex justify-end">
                            <a href="{{ route('posts.show', $comment->post_id) }}">show post</a>
                        </div>
                    </div>
                @endforeach
                <div class="w-full">
                    {{ $comments->links('pagination::tailwind') }}
                </div>
            @else
                <p>There are no posts</p>
            @endif
        </div>
    </div>
@endsection
