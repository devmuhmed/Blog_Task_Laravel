<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @yield('style')
    <title>Post</title>
</head>

<body class="bg-gray-200">
    <nav class="p-5 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a href="{{ route('categories.index') }}" class="p-3">Category</a>
            </li>
            <li>
                <a href="{{ route('posts.index') }}" class="p-3">Post</a>
            </li>
        </ul>
        <ul class="flex items-center">
            @auth
                <li>
                    <a href="{{ route('profiles.posts', auth()->id()) }}" class="p-3">{{ auth()->user()->name }}</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @endauth
            @guest
                <li>
                    <a href="{{ route('login') }}" class="p-3">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="p-3">Register</a>
                </li>
            @endguest
        </ul>
    </nav>
    @yield('content')
</body>

</html>
