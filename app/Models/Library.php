<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    protected $table = 'libraries';
    protected $fillable = [
        'number_books',
        'read_books',
        'all_pages',
        'read_pages',
        'user_id'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'library_book');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
