<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Ad\Entities\Ad;
use Modules\Review\Entities\Review;

class ItemPurchase extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    public function adDetails(): BelongsTo
    {
        return $this->belongsTo(Ad::class, 'ad_id', 'id',);
    }


    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id',);
    }
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id',);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class, 'order_id', 'id');
    }
    // public function review(): BelongsTo
    // {
    //     return $this->belongsTo(Review::class, 'id', 'order_id');
    // }
}
