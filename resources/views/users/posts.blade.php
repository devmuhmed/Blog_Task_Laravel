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
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-5">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ route('posts.index') }}" class="text-blue-500">Home</a>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    <a href="{{ route('profiles.comments', $user) }}" class="text-blue-500">comments on
                                        user's
                                        posts</a>
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
            @if ($posts->count())
                <div class="grid gap-6 mb-6 mt-6 md:grid-cols-2">
                    @foreach ($posts as $post)
                        <div>
                            <p>{{ $post->title }}</p>
                            <div>
                                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">
                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="post Pic" height="200">
                                    @endif
                                    <p>{{ $post->content }}</p>
                                </a>
                            </div>

                            <a href="{{ route('profiles.posts', $post->user_id) }}"
                                class="font-bold">{{ $post->user->name }}</a>
                            <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                            @auth
                                <div class="flex">
                                    @if ($post->ownedBy(auth()->user()))
                                        <div>
                                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="text-red-500"> Delete </button>
                                            </form>
                                        </div> |
                                        <div>
                                            <a href="{{ route('posts.edit', $post->id) }}" class="text-gray-500">Edit</a>
                                        </div> |
                                    @endif
                                </div>
                                @if (!$post->likedBy(auth()->user()))
                                    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                                        @csrf
                                        <button type="submit" class="text-blue-500">like</button>
                                    </form>
                                @else
                                    <form action="{{ route('likes.destroy', $post) }}" method="post" class="mr-1">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="text-blue-500">Unlike</button>
                                    </form>
                                @endif

                            @endauth
                            <span>{{ $post->likes->count() }}{{ Str::plural('like', $post->likes->count()) }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="w-full">
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            @else
                <p>There are no posts</p>
            @endif
        </div>
    </div>
@endsection
