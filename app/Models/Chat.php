<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'message',
        'user_id',
        'user_role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
