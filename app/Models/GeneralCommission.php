<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $product_id
 * @property mixed $amount
 * @property mixed $id
 */
class GeneralCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'amount'
    ];

    //Creating logical relationships
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


}
