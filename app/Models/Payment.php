<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        "student_id",
        "branch_id",
        "payment_date",
        "due_date",
        "payment_method",
        "invoice_des",
        "deposit",
        "year_academic"
    ];
}
