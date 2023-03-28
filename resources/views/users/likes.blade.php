@extends('layouts.app')
@section('style')
    <style>
        .w-5 {
            display: none;
        }

        .spaces {
            margin-bottom: 30px;
        }

        .leading-5 {
            margin: 5px;
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
                                    <a href="{{ route('profiles.posts', $user) }}" class="text-blue-500">posts of user</a>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <div class="flex items-center">
                                    <a href="{{ route('profiles.comments', $user) }}" class="text-blue-500">comments on
                                        user's
                                        posts</a>
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
            @else
                <p>There are no posts</p>
            @endif

            @if ($posts->count())
                @foreach ($comments as $comment)
                    {{-- <a href="{{ route('posts.show', $comment->post_id) }}">{{ $comment->post->title }}</a> --}}
                    <div
                        class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-4">
                        {{ $comment->user->name }}
                        <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                        <br>
                        {{ $comment->content }}
                        <span>{{ $comment->likes->count() }}{{ Str::plural('like', $comment->likes->count()) }}</span>
                        <div class="flex justify-end">
                            @if (!$comment->likedBy(auth()->user()))
                                <form action="{{ route('comments.likes', $comment) }}" method="post" class="mr-1">
                                    @csrf
                                    <button type="submit" class="text-blue-500">like</button>
                                </form>
                            @else
                                <form action="{{ route('commentslikes.destroy', $comment) }}" method="post"
                                    class="mr-1">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="text-blue-500">Unlike</button>
                                </form>
                            @endif
                            |<a href="{{ route('posts.show', $comment->post_id) }}">show post</a>
                        </div>
                    </div>
                @endforeach
                <div class="w-full spaces">
                    {{ $comments->links('pagination::tailwind') }}
                </div>
            @else
                <p>There are no comments you liked</p>
            @endif
        </div>
    </div>
@endsection
