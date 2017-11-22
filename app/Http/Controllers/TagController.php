<?php

namespace App\Http\Controllers;

use App\Tag;
use App\PostsTags;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all()
            ->sortBy('tag');

        return view('tag/list')
            ->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = $request->get('tag');

        try {
            $newTag = new Tag();
            $newTag->tag = $tag;
            $newTag->save();
            $msg = 'Tag guardado';
            $flashType = 'ok';
        } catch (QueryException $e) {
            $msg = 'Error al guardar el tag';
            $flashType = 'error';
        }

        return redirect()->route('tag.index')
            ->with($flashType, $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        $posts = $tag->posts();

        return view('tag/index')
            ->with('posts', $posts)
            ->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($tag)
    {
        return view('tag.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $input = $request->get('tag');

        try {
            $tag->tag = $input;
            $tag->save();
            $msg = 'Tag guardado';
            $flashType = 'ok';
        } catch (QueryException $e) {
            $msg = 'Error al guardar el tag';
            $flashType = 'error';
        }

        return redirect()->route('tag.index')
            ->with($flashType, $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        try {
            PostsTags::where('tag_id', $tag->id)
                ->delete();

            $tag->delete();
            $msg = 'Tag Eliminado';
            $flashType = 'ok';
        } catch (QueryException $e) {
            $msg = 'Error borrando tag';
            $flashType = 'error';
        }

        return redirect()->route('tag.index')
            ->with($flashType, $msg);
    }
}
