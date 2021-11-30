<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'stuno',
        'sunamekh',
        'finamekh',
        'sunameen',
        'finameen',
        'gender',
        'race',
        'tel',
        'national',
        'dob',
        'village',
        'commune',
        'district',
        'province',
        'img',
        'level',
        'from_school',
        'date_admission',
        'status',
        'farther_name',
        'mother_name',
        'farther_address',
        'mother_address',
        'father_job',
        'mother_job',
        'father_status',
        'mother_status',
        'father_race',
        'mother_race',
        'father_national',
        'mother_national',
        'branch_id'
    ];
}
