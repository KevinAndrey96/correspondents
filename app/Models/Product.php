<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commission;
use App\Models\SupplierProduct;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find(mixed $productID)
 * @method static where(string $string, int $int)
 * @method static whereIn(string $string, $shopkeeperProducts)
 * @property mixed $product_name
 * @property mixed $product_type
 * @property mixed $product_description
 * @property int|mixed $are_default_fields
 * @property mixed $client_document
 * @property mixed $account_type
 * @property mixed $extra
 * @property mixed $email
 * @property mixed $code
 * @property mixed $client_name
 * @property mixed $product_commission
 * @property mixed $min_amount
 * @property mixed $max_amount
 * @property mixed $priority
 * @property mixed $num_jineteo
 * @property mixed $hours
 * @property mixed $reassignment_minutes
 * @property mixed $com_shp
 * @property mixed $com_dis
 * @property mixed $com_sup
 * @property mixed $fixed_commission
 * @property mixed $giros
 * @property mixed|string $field_names
 * @property mixed|string $category
 */
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_name',
        'product_type',
        'product_description',
        'product_logo',
        'product_commission',
        'is_enabled',
        'client_name',
        'client_document',
        'phone_number',
        'email',
        'account_type',
        'account_number',
        'code',
        'extra',
        'min_amount',
        'max_amount',
        'priority',
        'num_jineteo',
        'hours',
        'reassignment_minutes',
        'fixed_commission',
        'giros',
        'is_deleted',
        'are_default_fields',
        'field_names'
    ];


    public function shopkeepers()
    {
    //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
    return $this->belongsToMany(
            User::class,
            'user_product',
            'product_id',
            'shopkeeper_id');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function supplierProducts()
    {
        return $this->hasMany(SupplierProduct::class);
    }
}
