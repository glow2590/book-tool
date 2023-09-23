<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSection extends Model
{
    use HasFactory;
    // add the fillable property
    protected $fillable = ['title', 'section_id', 'parent_id', 'slug', 'content'];
    // add the section relationship
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    // add the parent relationship
    public function parent()
    {
        return $this->belongsTo(SubSection::class, 'parent_id');
    }
    // add the children relationship
    public function subsections()
    {
        return $this->hasMany(SubSection::class, 'parent_id');
    }
}
