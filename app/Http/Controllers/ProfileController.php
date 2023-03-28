<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class ProfileController extends Controller
{
    public function posts(User $user)
    {
        $posts = Post::where('user_id', $user->id)->paginate(5);
        return view('users.posts', compact('posts', 'user'));
    }

    public function comments(User $user)
    {
        // dd($user->posts()->with('comments')->get());
        $postsId = $user->posts->pluck('id')->toArray();
        $comments = Comment::where('user_id', '!=', $user->id)->with('post')
            ->whereIn('post_id', $postsId)->paginate(5);
        return view('users.comments', compact('comments', 'user'));
    }

    public function likes(User $user)
    {
        // $comments = $user->likedComments()->paginate(2);
        // $posts = $user->likedPosts()->paginate(2);
        $comments = Comment::whereHas('likes', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate(2);

        $posts = Post::whereHas('likes', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate(2);

        return view('users.likes', compact('posts', 'comments', 'user'));
    }
}
