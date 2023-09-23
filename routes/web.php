<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// add the route to view a book
Route::get('/books/{book}', [App\Http\Controllers\BookController::class, 'show'])->name('books.show');
// add the route to create a section for a book
Route::get('/books/{book}/sections/create', [App\Http\Controllers\SectionController::class, 'create'])->name('sections.create');
// add a post route to create a section for a book
Route::post('/books/{book}/sections', [App\Http\Controllers\SectionController::class, 'store'])->name('sections.store');
//add the route to edit a section
Route::get('/books/{book}/sections/{section}', [App\Http\Controllers\SectionController::class, 'show'])->name('sections.show');

Route::get('/books/{book}/sections/{section}/edit', [App\Http\Controllers\SectionController::class, 'edit'])->name('sections.edit');
// add the route to update a section
Route::post('/books/{book}/sections/{section}/update', [App\Http\Controllers\SectionController::class, 'update'])->name('sections.update');
// add the route to delete a section
Route::get('/books/{book}/sections/{section}/delete', [App\Http\Controllers\SectionController::class, 'destroy'])->name('sections.destroy');
// show the section

// subsections

// create the subsection

Route::get('/books/{book}/sections/{section}/subsections/create', [App\Http\Controllers\SubSectionController::class, 'create'])->name('subsections.create');
// store the subsection
Route::post('/books/{book}/sections/{section}/subsections', [App\Http\Controllers\SubSectionController::class, 'store'])->name('subsections.store');
// create the subsection child
Route::get('/books/{book}/sections/{section}/subsections/{subsection}/subsections/create', [App\Http\Controllers\SubSectionController::class, 'child_create'])->name('subsections.child.create');
Route::post('/books/{book}/sections/{section}/subsections/{subsection}/subsections', [App\Http\Controllers\SubSectionController::class, 'child_store'])->name('subsections.child.store');
//edit the subsection
Route::get('/books/{book}/sections/{section}/subsections/{subsection}/edit', [App\Http\Controllers\SubSectionController::class, 'edit'])->name('subsections.edit');
// update the subsection
Route::post('/books/{book}/sections/{section}/subsections/{subsection}/update', [App\Http\Controllers\SubSectionController::class, 'update'])->name('subsections.update');
// delete the subsection
Route::get('/books/{book}/sections/{section}/subsections/{subsection}/delete', [App\Http\Controllers\SubSectionController::class, 'destroy'])->name('subsections.destroy');

// route to create a collaborator
Route::get('/books/{book}/collaborators/create', [App\Http\Controllers\CollabortorContoller::class, 'create'])->name('collaborators.create');
// route to store a collaborator
Route::post('/books/{book}/collaborators', [App\Http\Controllers\CollabortorContoller::class, 'store'])->name('collaborators.store');
// route to delete a collaborator
Route::get('/books/{book}/collaborators/{collaborator}/delete', [App\Http\Controllers\CollabortorContoller::class, 'destroy'])->name('collaborators.destroy');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
