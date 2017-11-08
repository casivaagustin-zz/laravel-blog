<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostsTags;
use App\Section;
use App\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('id')
            ->get();

        return view('posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        $tags = Tag::all();
        return view('posts.create', [
            'sections' => $sections,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->get('title');
        $body = $request->get('body');
        $section = $request->get('section');
        $tags = $request->get('tags');

        try {
            $newPost = new Post();
            $newPost->title = $title;
            $newPost->body = $body;
            $newPost->section_id = $section;
            $newPost->save();

            foreach ($tags as $tag_id) {
                $postTag = new PostsTags();
                $postTag->post_id = $newPost->id;
                $postTag->tag_id = $tag_id;
                $postTag->save();
            }

            $msg = 'Post guardado';
            $flashType = 'ok';
        } catch (QueryException $e) {
            $msg = 'Error al guardar el post';
            $flashType = 'error';
        }

        return redirect()->route('post.index')
            ->with($flashType, $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts/view')
            ->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $sections = Section::all();
        $tags = Tag::all();

        return view('posts.edit', [
            'sections' => $sections,
            'post' => $post,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $title = $request->get('title');
        $body = $request->get('body');
        $section = $request->get('section');
        $tags = $request->get('tags');

        try {
            $post->title = $title;
            $post->body = $body;
            $post->section_id = $section;
            $post->save();

            PostsTags::where('post_id', $post->id)
                ->delete();

            foreach ($tags as $tag_id) {
                $postTag = new PostsTags();
                $postTag->post_id = $post->id;
                $postTag->tag_id = $tag_id;
                $postTag->save();
            }

            $msg = 'Post actualizado';
            $flashType = 'ok';
        } catch (QueryException $e) {
            $msg = 'Error al guardar el post';
            $flashType = 'error';
        }

        return redirect()->route('post.index')
            ->with($flashType, $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        PostsTags::where('post_id', $post->id)
            ->delete();

        $post->delete();
        $msg = 'Post Eliminado';
        $flashType = 'ok';

        return redirect()->route('post.index')
            ->with($flashType, $msg);
    }
}
