<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibBook extends Model
{
    use HasFactory;
    protected $table = 'library_book';
    protected $fillable = [
        'library_id',
        'book_id',
        'condition_id',
        'sign',
        'read_pages'
    ];
}
