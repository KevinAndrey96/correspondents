<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $comm_group_id
 * @property mixed $gen_comm_id
 * @method static get()
 * @method static where(string $string)
 */
class CommissionsGroupGeneralCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'comm_group_id',
        'gen_comm_id'
    ];

    public function commissionGroup()
    {
        return $this->belongsTo(CommissionsGroup::class, 'comm_group_id');
    }

    public function generalCommission()
    {
        return $this->belongsTo(GeneralCommission::class, 'gen_comm_id');
    }

}
