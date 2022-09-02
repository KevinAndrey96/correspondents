<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find($id)
 * @property int $product_id
 * @property mixed $amount
 * @property Carbon|mixed $date
 * @property mixed $type
 * @property mixed|string $status
 */
class Transaction extends Model
{
    use HasFactory;

    public const TYPE_DEPOSIT = 'Deposit';

    public const TYPE_WITHDRAWAL = 'Withdrawal';

    protected $fillable = [
        'shopkeeper_id',
        'distributor_id',
        'supplier_id',
        'admin_id',
        'product_id',
        'account_number',
        'amount',
        'type',
        'status',
        'detail',
        'date',
        'voucher',
        'comment',
        'com_adm',
        'com_dis',
        'com_sup',
        'com_shp'
    ];

    public function shopkeeper(): BelongsTo
    {
        return $this->belongsTo(User::class, 'shopkeeper_id');
    }

    public function distributor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'distributor_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(User::class,'supplier_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
