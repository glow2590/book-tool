<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Section;
use App\Models\SubSection;
use Illuminate\Http\Request;

class SubSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($book, $section)
    {
        // create the create method
        return view('books.sections.sub-sections.create', [
            'book' => $book,
            'section' => $section,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($book, $section, Request $request)
    {
        //check if the user is the author of the book
        $section    = Section::findOrFail($section);

        $book = Book::findOrFail($book);

        if ($request->user()->id !== $book->author_id) {
            abort(403);
        }
        // validate the request
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        // create the store method logic
        $subSection = new SubSection();
        $subSection->title = $request->title;
        $subSection->content = $request->content;
        $subSection->slug = \Str::slug($request->title);
        $subSection->section_id = $section->id;
        $subSection->save();
        // redirect the user to the section
        return redirect()->route('sections.show', [$book, $section]);
    }

    public function child_create($book, $section, $subsection)
    {
        return view('books.sections.sub-sections.create', [
            'book' => $book,
            'section' => $section,
            'subsection' => $subsection,
        ]);
    }
    public function child_store($book, $section, $subsection, Request $request)
    {
        //check if the user is the author of the book
        $parent = SubSection::findOrFail($subsection);
        $section    = Section::findOrFail($section);

        $book = Book::findOrFail($book);

        if ($request->user()->id !== $book->author_id) {
            abort(403);
        }
        // validate the request
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        // create the store method logic
        $subSection = new SubSection();
        $subSection->title = $request->title;
        $subSection->content = $request->content;
        $subSection->slug = \Str::slug($request->title);
        $subSection->section_id = $section->id;
        $subSection->parent_id = $parent->id;
        $subSection->save();
        // redirect the user to the section
        return redirect()->route('sections.show', [$book, $section]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubSection  $subSection
     * @return \Illuminate\Http\Response
     */
    public function show(SubSection $subSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubSection  $subSection
     * @return \Illuminate\Http\Response
     */
    public function edit($book, $section,  $subsection)
    {
        // create the edit method

        $subSection = SubSection::findOrFail($subsection);
        return view('books.sections.sub-sections.edit', [
            'book' => $subSection->section->book,
            'section' => $subSection->section,
            'subsection' => $subSection,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubSection  $subSection
     * @return \Illuminate\Http\Response
     */
    public function update($book, $section, $subSection, Request $request)
    {
        //check if the user is the author of the book or collaborator
        $subSection = SubSection::findOrFail($subSection);
        $book = $subSection->section->book;
        if ($request->user()->id !== $book->author_id && !$book->collaborators->contains($request->user())) {
            abort(403);
        }
        // validate the request
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        // create the update method logic
        $subSection->title = $request->title;
        $subSection->content = $request->content;
        $subSection->slug = \Str::slug($request->title);
        $subSection->save();
        // redirect the user to the section
        return redirect()->route('sections.show', [$book, $subSection->section]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubSection  $subSection
     * @return \Illuminate\Http\Response
     */
    public function destroy($book, $section, $subsection)
    {
        $subSection = SubSection::findOrFail($subsection);
        // create the destroy method but first check if the user is the author of the book or collaborator
        if (auth()->user()->id !== $subSection->section->book->author_id) {
            abort(403);
        }
        //delete the subsection
        $subSection->delete();
        // redirect the user to the section
        return redirect()->route('sections.show', [$book, $section]);
    }
}
