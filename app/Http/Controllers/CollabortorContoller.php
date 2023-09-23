<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CollabortorContoller extends Controller
{
    // make the create method
    public function create($book)
    {
        // add the create method logic
        return view('books.collaborators.create', [
            'book' => $book,
        ]);
    }

    // make the store method
    public function store($book)
    {
        // add the store method logic
        $book = Book::findOrFail($book);

        if (auth()->user()->id !== $book->author_id) {
            abort(403);
        }

        $book->collaborators()->attach(request()->user()->id);

        return redirect()->route('books.show', $book->id);
    }
    // make the destroy method
    public function destroy($book)
    {
        // add the destroy method logic
        $book = Book::findOrFail($book);

        if (auth()->user()->id !== $book->author_id) {
            abort(403);
        }

        $book->collaborators()->detach(request()->user()->id);

        return redirect()->route('books.show', $book->id);
    }
}
