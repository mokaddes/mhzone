<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Ad\Entities\Ad;

class ShipingLocations extends Model
{
    use HasFactory;


    public function products():HasMany
    {
        return $this->hasMany(Ad::class,'country','id');
    }
    public function available_product()
    {
        return $this->products()->where('status', '!=', 'pending')->where('validity', '>', now());
    }
}
