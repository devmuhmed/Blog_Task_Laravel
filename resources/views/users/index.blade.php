@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="mb-5">
                <a href="{{ route('posts.index') }}" class="text-black-500">Home</a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-5">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ route('profiles.posts', $user) }}" class="text-blue-500">posts of user</a>
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
        </div>
    </div>
@endsection
