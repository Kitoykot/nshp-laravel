<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "category_id",
        "price",
        "image",
        "user_id",
        "public",
    ];
}
