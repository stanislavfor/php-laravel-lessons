<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'genre',
        'description',
        'publication_year',
        'publisher',
        'pages',
        'cover'
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'pages' => 'integer',
    ];

    public function getCoverAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
