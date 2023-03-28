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
    @if (session()->has('delete'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">Danger alert!</span> <strong>{{ session()->get('delete') }}</strong>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-1" aria-label="Close">
        </div>
    @endif
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="flex justify-end">
                <div>
                    @auth
                        <a href="{{ route('posts.create') }}" class="btn border-200 p-100 plus">+</a>
                    @endauth
                </div>
            </div>
            <div>
                @if ($posts->count())
                    <div class="grid gap-6 mb-6 mt-6 md:grid-cols-2">
                        @foreach ($posts as $post)
                            <div>
                                <div>
                                    <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">
                                        @if ($post->image)
                                            <img src='{{ asset("storage/$post->image") }}' alt="post Pic" height="200"
                                                width="300" class="mb-2">
                                        @endif
                                        <p>{{ $post->content }}</p>
                                    </a>
                                </div>

                                {{-- <img src="{{ asset('storage/' . $post->image) }}" alt="post Pic" height="200" --}}
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
                                        <div>
                                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">show</a>
                                        </div>
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
                            {{-- </div> --}}
                        @endforeach
                    </div>
                    <div class="w-full">
                        {{-- {{ $posts->links('pagination::tailwind') }} --}}
                    </div>
                @else
                    <p>There are no posts</p>
                @endif
            </div>
        </div>
    </div>
@endsection
