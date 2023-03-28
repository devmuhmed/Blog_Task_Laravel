<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $request->user()->comments()->create([
            'content' => $request->content,
            'post_id' => $request->post_id
        ]);
        return redirect()->back();
    }
}
