<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeasurementsPoint extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_at', 'updated_at', 'status'];

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\MeasurementsPointFactory::new();
    }
}
