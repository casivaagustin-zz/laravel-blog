<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all()
            ->sortBy('section');

        return view('section/list')
            ->with('sections', $sections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = $request->get('section');

        try {
            $newSection = new Section();
            $newSection->section = $section;
            $newSection->save();
            $msg = 'Seccion guardada';
            $flashType = 'ok';
        } catch (QueryException $e) {
            $msg = 'Error al guardar la seccion';
            $flashType = 'error';
        }

        return redirect()->route('section.index')
            ->with($flashType, $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::find($id);
        $posts = $section->posts();

        return view('section/index')
            ->with('posts', $posts)
            ->with('section', $section);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        return view('section.edit', [
            'section' => $section,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $input_section = $request->get('section');

        try {
            $section->section = $input_section;
            $section->save();
            $msg = 'Seccion guardada';
            $flashType = 'ok';
        } catch (QueryException $e) {
            $msg = 'Error al guardar la seccion';
            $flashType = 'error';
        }

        return redirect()->route('section.index')
            ->with($flashType, $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        try {
            $section->delete();
            $msg = 'Seccion Eliminada';
            $flashType = 'ok';
        } catch (QueryException $e) {
            $msg = 'Hay post relacionados a la sección, no se puede borrar';
            $flashType = 'error';
        }

        return redirect()->route('section.index')
            ->with($flashType, $msg);
    }
}
