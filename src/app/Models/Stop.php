<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Stop
 *
 * @property int $id
 * @property int $postcode
 * @property int $city_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Stop extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'shipment_id',
        'order_position',
        'updated_at',
        'created_at',
    ];

    /**
     * @return BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(Shipment::class);
    }
}
