<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        "fname", 
        "lname", 
        "gender", 
        "dob", 
        "type_id", 
        "tel", 
        "hire",
        "stime",
        "ltime",
        "email",
        "national", 
        "photo",
        "employee_type",
        "marital_status",
        "village",
        "commune", 
        "district", 
        "province",
        "branch_id"
    ];
}
