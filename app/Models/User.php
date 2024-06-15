<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'picture',
        'password',
        'about',
        'admin'
    ];

    protected $hidden = [
        'password'
    ];

    public function isAdmin(): bool
    {
        return $this->admin;
    }    

    public function posts()
    {
        return $this->hasMany(Post::class);
    }    
}
