<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Ad\Entities\Ad;

class RecentViewAd extends Model
{
    protected $fillable =['session_id','ad_id','created_by','updated_by'];
    use HasFactory;

    public function ads():HasOne
    {
        return $this->hasOne(Ad::class,'id','ad_id');
    }
}
