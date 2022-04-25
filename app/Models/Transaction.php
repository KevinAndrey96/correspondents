<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

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
        $this->belongsTo(User::class, 'foreign_key', 'shopkeeper_id');
    }

    public function distributor()
    {
        $this->belongsTo(User::class, 'foreign_key', 'distributor_id');
    }

    public function supplier()
    {
        $this->belongsTo(User::class, 'foreign_key', 'supplier_id');
    }

    public function admin()
    {
        $this->belongsTo(User::class, 'foreign_key', 'admin_id');
    }

    public function product()
    {
        $this->belongsTo(Product::class);
    }

}
