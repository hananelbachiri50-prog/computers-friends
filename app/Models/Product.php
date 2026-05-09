<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'gallery',
        'specs',
        'price',
        'description',
    ];

    protected $casts = [
        'gallery' => 'array',
    ];

}


