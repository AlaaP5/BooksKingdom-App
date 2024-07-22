<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'age',
        'role_id',
        'code',
        'StatusCode',
        'password',
        'evaluation',
        'fcm_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
