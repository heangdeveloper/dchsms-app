<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;
    protected $fillable = ['stu_id', 'class_id', 'academic_year_id', 'stime', 'etime', 'curriculum_id', 'branch_id'];
}
