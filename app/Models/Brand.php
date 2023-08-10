<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'square_logo_url',
        'rectangular_logo_url',
        'primary_color',
        'secondary_color',
        'banner'
    ];
}

