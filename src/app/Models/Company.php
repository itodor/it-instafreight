<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Company extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'id',
        'updated_at',
        'created_at',
    ];
}
