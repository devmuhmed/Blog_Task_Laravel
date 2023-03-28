@extends('layouts.app')

@section('style')
    <style>
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
        <div class="bg-red-500 p-4 rounded mb-6 text-white text-center" role="alert">
            <span class="font-medium">Danger alert!</span> <strong>{{ session()->get('delete') }}</strong>
            <button type="button" data-dismiss-target="#alert-1" aria-label="Close">
        </div>
    @endif
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth
                <div class="flex justify-end">
                    @auth
                        <a href="{{ route('categories.create') }}" class="btn border-200 p-100 plus">+</a>
                    @endauth
                </div>
                <div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Name
                                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1"
                                                    aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                                    <path
                                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                                                </svg></a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Parent
                                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1"
                                                    aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                                    <path
                                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                                                </svg></a>
                                        </div>
                                    </th>
                                    @auth
                                        <th scope="col" class="px-6 py-3">
                                            operation
                                        </th>
                                    @endauth
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $category->parent->name }}
                                        </td>
                                        @auth
                                            <td>
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-red-500 text-white px-4 py-2 rounded font-medium">Delete</button>
                                                    <a href="{{ route('categories.edit', $category) }}" style="display:inline-block"
                                                        class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Edit</a>
                                                </form>
                                            </td>
                                        @endauth
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endauth
            @guest
                <ul
                    class="w-48 mb-8 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach ($categories as $category)
                        <a href="{{ route('categories.show', $category) }}">
                            <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                {{ $category->name }}
                                @foreach ($category->children as $child)
                                    <ul
                                        class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <li class="w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                            {{ $child->name }}</li>
                                    </ul>
                                @endforeach
                            </li>
                        </a>
                    @endforeach
                </ul>
            @endguest
        </div>
    </div>
@endsection
