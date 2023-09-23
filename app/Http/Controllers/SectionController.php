<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Section;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($book)
    {
        $book = Book::findOrFail($book);

        if (auth()->user()->id !== $book->author_id) {
            abort(403);
        }
        // add the create method logic
        return view('books.sections.create', [
            'book' => $book,
            'section' => new Section()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $book)
    {

        $book = Book::findOrFail($book);
        if (!$book) {
            abort(404);
        } else if (auth()->user()->id !== $book->author_id) {
            abort(403);
        }
        //generate the slug for the section based on title
        $request->merge([
            'slug' => \Str::slug($request->title)
        ]);
        //write the store method logic
        $section = $book->sections()->create($request->all());
        //flash message success
        if ($section) {
            session()->flash('success', 'Section was created');
        } else {
            session()->flash('error', 'Section was not created');
        }
        return redirect()->route('books.show', $book->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($book, $section)
    {
        //add the show method logic
        $section = Section::findOrFail($section);
        return view('books.sections.show', [
            'section' => $section,
            'book' => $section->book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($book, $section)
    {
        //add the edit method logic

        //check if the user is authorized to edit the section
        $section = Section::find($section);
        $book = Book::find($book);
        if ($book->collaborators->contains(auth()->user()) || auth()->user()->id == $book->author_id) {
            return view('books.sections.edit', [
                'section' => $section,
                'book' => $section->book
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($book, $section)
    {
        //find the section
        $section = Section::findOrFail($section);
        //check if the authenticated user is a collaborator
        $book = Book::find($book);
        if ($book->collaborators->contains(auth()->user()) || auth()->user()->id == $book->author_id) {
            //update the section
            $section->update(request()->all());
            //flash message success
            session()->flash('success', 'Section was updated');
            //redirect to the section
            return redirect(route('sections.show', ['book' => $book->id, 'section' => $section->id]));
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($book, $section)
    {
        ////add the destroy method logic
        //find the section
        $section = Section::findOrFail($section);
        //check if the authenticated user is a collaborator
        if (auth()->user()->id == $section->book->author_id) {
            //delete the section
            $section->delete();
            //flash message success
            session()->flash('success', 'Section was deleted');
            //redirect to the book
            return redirect()->route('books.show', $section->book->id);
        } else {
            abort(403);
        }
    }
}
