<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commission;

class Product extends Model
{
    use HasFactory;

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
}
