<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'name',
        'content',
        'author_id',
        'type_id',
        'status_id',
        'date_publication',
        'description',
        'image',
        'evaluation',
        'price',
        'pages',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function state()
    {
        return $this->belongsTo(Status::class);
    }

    public function libraries()
    {
        return $this->belongsToMany(Library::class, 'library_book');
    }
}
