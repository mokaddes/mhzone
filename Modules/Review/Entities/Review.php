<?php

namespace Modules\Review\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ad\Entities\Ad;
use Modules\Product\Entities\Product;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'stars',
        'comment',
        'status',
        'fastShipper',
        'itemAsDescribed',
        'quickReplies',
        'order_id',
        'user_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Review\Database\factories\ReviewFactory::new();
    }

    /**
     * Get the user for the review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function ads(): BelongsTo
    {
        return $this->belongsTo(Ad::class, 'item_id', 'id');
    }
}
