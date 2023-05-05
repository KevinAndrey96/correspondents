<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductField extends Model
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
        'min_amount',
        'max_amount',
        'priority',
        'num_jineteo',
        'hours',
        'reassignment_minutes',
        'fixed_commission'
    ];

}
