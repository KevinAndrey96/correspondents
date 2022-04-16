<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'com_adm',
        'com_dis',
        'com_sup',
        'com_shp'
    ];

    public function pr
}
