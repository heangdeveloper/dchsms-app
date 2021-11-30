<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = [
        "teacher_id",
        "student_id",
        "class_id",
        "term_id",
        "branch_id",
        "lart",
        "math",
        "science",
        "art",
        "music",
        "khmer",
        "moral",
        "total"
    ];
}
