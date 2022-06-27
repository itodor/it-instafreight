<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Shipment
 *
 * @property int $id
 * @property int $distance
 * @property int $time
 * @property int $company_id
 * @property int $carrier_id
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Carrier|null $carrier
 * @property-read Company|null $company
 *
 **/
class Shipment extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'company_id',
        'carrier_id',
        'updated_at',
        'created_at',
    ];

    /**
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    /**
     * @return HasMany
     */
    public function stops()
    {
        return $this->hasMany(Stop::class);
    }
}
