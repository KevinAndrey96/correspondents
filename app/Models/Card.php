<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @method static find(int $cardID)
 */
class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'cardIMG',
        'cardPDF',
        'bank',
        'min_amount',
        'penalty'
    ];
}
