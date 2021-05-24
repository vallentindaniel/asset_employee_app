<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    use HasFactory;


    /**
     * Get the manager that owns the CostCenter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

   /**
    * Get all of the asset for the CostCenter
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function asset(): HasMany
   {
       return $this->hasMany(Asset::class, 'cost_center_id', 'id');
   }




}
