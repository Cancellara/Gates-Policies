<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Response;


class PostController extends Controller
{
    public function update (Post $post, UpdatePostRequest $request) {

        //$this->authorize('update', $post);

        $post->update([
            'title' => $request->title,
        ]);

        return 'Post updated!';
    }

    /*public function create()
    {
        $this->authorize('create', Post::class);
    }*/

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        $request->user()->posts()->create([
            'title' => $request->title,
        ]);
        return new Response('Post created', 201);
    }
    /*public function edit(Post $post)
    {
        $this->authorize('update', $post);
    }*/
}
