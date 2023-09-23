<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    // add the fillable property
    protected $fillable = ['title', 'author_id', 'slug', 'overview', 'image'];


    // add the the sections relationship
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    // add the author relationship
    public function author()
    {
        return $this->belongsTo(User::class,    'author_id');
    }
    //add the collaborators relationship
    public function collaborators()
    {
        return $this->belongsToMany(User::class, 'collaborators');
    }
}
