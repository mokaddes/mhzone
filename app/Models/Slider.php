<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['content_title', 'content_body', 'seller_id', 'status', 'path'];
    protected $appends = ['image_url'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'seller_id');
    }

    public function getImageUrlAttribute()
    {
        return asset($this->path);
    }
}
