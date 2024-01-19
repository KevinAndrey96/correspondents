<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $user_id
 * @property mixed $amount
 * @property Carbon|mixed $date
 * @property mixed|string $type
 * @property mixed|string $extra
 * @property int|mixed $is_valid
 */
class Profit extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function administrator()
    {
        return $this->belongsTo(User::class, 'administrator_id');
    }

}
