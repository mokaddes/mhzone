<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ad\Entities\Ad;

class OrderDetail extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id'); 
    }
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }
    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id', 'id');
    }
}
