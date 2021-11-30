<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductServices extends Model
{
    use HasFactory;
    protected $fillable = [
        "pro_service",
        "price_service",
        "id_service_type",
        "id_academic",
        "pay_month",
        "branch_id"
    ];
}
