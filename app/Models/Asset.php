<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->using(AssetUser::class);
    }

    /**
     * Get the costCenter that owns the Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id', 'id');
    }

    /**
     * Get all of the assetUser for the Asset
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assetUser(): HasMany
    {
        return $this->hasMany(AssetUser::class, 'asset_id', 'id');
    }


}
