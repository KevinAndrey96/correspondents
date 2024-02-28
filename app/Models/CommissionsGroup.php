<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $name
 * @property mixed $id
 * @method static get()
 * @method static find(int $intval)
 * @method static where(string $string, $id)
 */
class CommissionsGroup extends Model
{
    use HasFactory;

    protected $fillable = [
      'name'
    ];
}
