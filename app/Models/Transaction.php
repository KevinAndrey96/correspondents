<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

/**
 * @method static find($id)
 */
class Transaction extends Model
{
    use HasFactory;
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


    /*
     *  public function user(){
        return $this->hasOne('App/Models/User','id','shopkeeper_id');
    }
     */

    public function shopkeeper()
    {
        return $this->belongsTo(User::class, 'shopkeeper_id');
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class,'supplier_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
