<?php

namespace App\Http\Controllers;

use App\Http\Traits\Handling;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    use Handling;
    public function storepost(Post $post, Request $request)
    {
        $this->storeModel($post, $request);
        return back();
    }

    public function destroypost(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();
        return back();
    }

    public function store(Comment $comment, Request $request)
    {
        $this->storeModel($comment, $request);
        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->likes()->where('user_id', auth()->id())->delete();
        return back();
    }
}
