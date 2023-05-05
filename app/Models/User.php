<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SupplierProduct;
use App\Models\Product;
use Lab404\Impersonate\Models\Impersonate;

/**
 * @property mixed|string $name
 * @property mixed|string $email
 * @property mixed|string $password
 * @property mixed|string $role
 * @property mixed|string $phone
 * @property mixed|string $document_type
 * @property mixed|string $document
 * @property mixed|string $city
 * @property mixed|string $address
 * @property int|mixed $is_enabled
 * @property string $google2fa_secret
 * @property int|mixed $balance
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;
    use Impersonate;

    protected $table = 'users';

    public const STATUS_ENABLED = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'max_queue',
        'document_type',
        'document',
        'city',
        'address',
        'priority',
        'is_enabled',
        'is_authorized',
        'is_online',
        'distributor_id',
        'balance',
        'profit',
        'google2fa_secret',
        'last_login',
        'daily_password',
        'daily_password_date',
        'daily_verified',
        'first_login',
        'multiproductosID',
        'platform_mul',
        'cedulaPDF',
        'rutPDF',
        'camara_comercio',
        'local_photo',
        'public_receipt',
        'enabled_daily',
        'product_id',
        'was_impersonated'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
    //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
    return $this->belongsToMany(
            Product::class,
            'user_product',
            'shopkeeper_id',
            'product_id');
    }

    public function distributor()
    {
        return $this->belongsTo(User::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function commission()
    {
        return $this->hasOne(Commission::class);
    }

    public function supplierProducts()
    {
        return $this->hasMany(SupplierProduct::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Interact with the user's first name.
     * @see google2faSecret
     */
    protected function google2faSecret(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  decrypt($value),
            set: fn ($value) =>  encrypt($value),
        );
    }
}
