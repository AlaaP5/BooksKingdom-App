<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = 'authors';
    protected $fillable = [
        'name',
        'age',
        'image',
        'from',
        'His_university',
        'description',
        'About_It'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
