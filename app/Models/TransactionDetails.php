<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetails extends Model
{
    use HasFactory;

    protected $appends = ['transaction_number', 'payment_status', 'commission'];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function getTransactionNumberAttribute(){

        return $this->transaction->transaction_number;

    }
    public function getPaymentStatusAttribute(){

        return $this->transaction->payment_status;

    }
    public function getCommissionAttribute()
    {
        return (setting('admin_commission') *  $this->amount)/100;
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }


}
