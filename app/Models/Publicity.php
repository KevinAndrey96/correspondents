<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicity extends Model
{
    use HasFactory;

    protected $fillable = [
        'publicity_url'
    ];
}
