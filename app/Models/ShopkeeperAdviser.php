<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ShopkeeperAdviser extends Model
{
    use HasFactory;

    protected $fillable = [
      'shopkeeper_id',
      'adviser_id'
    ];

    public function shopkeeper()
    {
        return $this->belongsTo(User::class, 'shopkeeper_id');
    }

    public function adviser()
    {
        return $this->belongsTo(User::class, 'adviser_id');
    }
}
