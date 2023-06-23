<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    use HasFactory;
    protected $table = 'output';
    protected $fillable = [
        'task_code',
        'activity_code',
        'student_id',
        'first_name',
        'last_name',
        'adviser_id',
        'title',
        'description',
        'due_date',
        'attachments',
        'status',
        'score',
        'score_submitted'

    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'account_code', 'student_id');
    }
}
