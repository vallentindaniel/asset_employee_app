<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetUser extends Model
{
    use HasFactory;

    //protected $primaryKey = ['asset_id', 'employee_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'id',
        'asset_id',
        'employee_id',
        'from',
        'to',
        'end_of_life'
    ];

    /**
     * Get the user that owns the AssetUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }


    /**
     * Get the asset that owns the AssetUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }


    /**
     * Get all of the costCenter for the AssetUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
   /*  public function costCenter()
    {
        return $this->hasOneThrough(
            CostCenter::class,
            Asset::class,
            'cost_center_id',
            'id',
            'cost_center_id',
            'id'
        );
    } */

}
