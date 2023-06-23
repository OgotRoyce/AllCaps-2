<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Adviser extends Authenticatable
{
    use HasFactory;
    protected $table = 'adviser';
    protected $fillable = [
        'adviser_id',
        'first_name',
        'last_name',
        'email',
        'program',
        'password',
        'photo',
        'counter'
    ];
}
