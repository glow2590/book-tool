<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    use HasFactory;
    // add the fillable property
    protected $fillable = ['used_id', 'book_id', 'role'];
    //add the collaborated books relationship
    public function collaboratedBooks()
    {
        return $this->belongsToMany(Book::class, 'collaborators');
    }
}
