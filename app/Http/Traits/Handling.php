<?php

namespace App\Http\Traits;

trait Handling
{
    protected function getNameOfImage($r)
    {
        if ($r->hasFile('image')) {
            $r->image->move(public_path('images/posts'), $r->file('image')->getClientOriginalName());
            return $r->file('image')->getClientOriginalName();
        }
        return null;
    }

    public function storeModel($model, $request)
    {
        if ($model->likedBy($request->user())) {
            return redirect()->route('posts.index');
        }
        $model->likes()->create([
            'user_id' => auth()->id(),
        ]);
    }
}
