@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="flex justify-center">
                <div class="w-8/12 bg-white p-6 rounded-lg">
                    <a href="{{ route('profiles.posts', $post->user_id) }}" class="font-bold">{{ $post->user->name }}</a>
                    <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    <p>{{ $post->title }}</p>
                    <pre>
                        <p>{{ $post->content }}</p>
                    </pre>
                    @if ($post->image)
                        {{-- <img src='{{ asset("images/posts/$post->image") }}' alt="post Pic" height="500" width="800"
                            class="mb-2"> --}}
                        <img src='{{ asset("storage/$post->image") }}' alt="post Pic" height="500" width="800"
                            class="mb-2">
                    @endif
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
                            </div>
                        </div>
                        <div class="flex">
                            <span>{{ $post->likes->count() }}{{ Str::plural('like', $post->likes->count()) }}</span>
                        </div>
                        <form action="{{ route('comments.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="grid gap-6 mb-6 mt-6 md:grid-cols-2">
                                <input type="title" name="content" id="content" placeholder="your comment"
                                    class="bg-gray-100 border-2  w-full p-4 rounded-lg " value="">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Add Comment</button>
                                @error('content')
                                    <div class="text-red-500 text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </form>
                        @foreach ($post->comments as $comment)
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
                                </div>
                            </div>
                        @endforeach
                    @endauth
                    @guest
                        @foreach ($post->comments as $comment)
                            <div
                                class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-4">
                                {{ $comment->user->name }}
                                <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                                <br>
                                {{ $comment->content }}
                                <span>{{ $comment->likes->count() }}{{ Str::plural('like', $comment->likes->count()) }}</span>
                            </div>
                        @endforeach
                        <div class="flex justify-center">
                            please register to show comments &nbsp;<a href="{{ route('login') }}"><b>
                                    <i>Login </i></b></a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
