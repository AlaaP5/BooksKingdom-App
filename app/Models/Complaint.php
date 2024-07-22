<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $table = 'complaints';
    protected $fillable = [
        'user_id',
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }
}
