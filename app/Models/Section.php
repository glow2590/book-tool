<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    // add the fillable property
    protected $fillable = ['title', 'book_id', 'slug', 'content'];
    // add the ssubsections relationship
    public function subsections()
    {
        return $this->hasMany(Subsection::class);
    }
    // add the book relationship
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
