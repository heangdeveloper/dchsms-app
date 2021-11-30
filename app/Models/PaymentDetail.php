<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_invoice",
        "id_payment",
        "id_inovice_type",
        "id_pro_service",
        "id_payterm",
        "user_id_pay",
        "description",
        "qty",
        "ori_price",
        "disccount",
        "total_amount",
        "total_payment",
        "lose_piad",
        "Volidty_of_payment",
        "expired_date",
        "school_year",
        "remark",
        "branch_id"
    ];
}
