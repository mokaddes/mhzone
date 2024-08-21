<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ad\Entities\Ad;

class RequestedProduct extends Model
{
    use HasFactory;

    public function ads(): BelongsTo
    {
        return $this->belongsTo(Ad::class, 'ads_id', 'id');
    }
}
