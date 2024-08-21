<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ad\Entities\Ad;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Modules\ChildCategory\Entities\ChildCategory;

class AdsSize extends Model
{
    use HasFactory;

    protected $fillable = ['status'];


    public function childCategory(): BelongsTo
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id', 'id');
    }
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function ads(): BelongsTo
    {
        return $this->belongsTo(Ad::class, 'id', 'size_id');
    }

    /**
     *  Active Category scope
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
