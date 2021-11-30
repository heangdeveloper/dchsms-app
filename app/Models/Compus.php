<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compus extends Model
{
    use HasFactory;
    protected $table = "branches";
    protected $fillable = ["name_kh", "name_en"];
}
