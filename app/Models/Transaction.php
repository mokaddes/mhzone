<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ad\Entities\Ad;
use Modules\Coupon\Entities\Coupon;
use Modules\Plan\Entities\Plan;

/**
 * @property mixed $transaction_number
 */
class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Transaction customer
     *
     * @return BelongsTo
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     *  Customer scope
     * @return mixed
     */
    public function scopeCustomerData($query, $api = false)
    {
        if ($api) {
            return $query->where('user_id', auth('api')->id());
        } else {
            return $query->where('user_id', auth('user')->id());
        }
    }

    /**
     * Transaction plan
     *
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Transaction Details
     * @return BelongsTo
     */
    public function transactionDetails():BelongsTo
    {
        return $this->hasMany(TransactionDetails::class);
    }


}
