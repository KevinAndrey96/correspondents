<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Card;

/**
 * @method static where(array[] $array)
 * @method static find($id)
 */
class Balance extends Model
{
    use HasFactory;

    public function user(){
        //return $this->hasOne('App/Models/User','id','user_id');
        return $this->belongsTo(User::class);
    }


    public function administrator()
    {
        return $this->belongsTo(User::class, 'administrator_id');
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
