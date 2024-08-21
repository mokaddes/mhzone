<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsAttr extends Model
{
    use HasFactory;

    public function parent_attr()
    {
        return $this->belongsTo(Attribute::class, 'attr_id');
    }
}
