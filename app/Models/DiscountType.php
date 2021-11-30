<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountType extends Model
{
    use HasFactory;
    protected $fillable = [
        "discount_name",
        "percent_dis",
        "from_date",
        "exp_date",
        "note",
        "status"
    ];
}
