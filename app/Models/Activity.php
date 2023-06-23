<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activity';
    protected $fillable = [
        'task_code',
        'title',
        'description',
        'due_date',
        'attachments'
        ];
}
