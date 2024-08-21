<?php

namespace Modules\Category\Entities;

use App\Models\AdsSize;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ChildCategory\Entities\ChildCategory;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'mesurement_point',
    ];

    /**
     *  Active Subcategory scope
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\SubCategoryFactory::new();
    }

    /**
     * Set the subcategory name.
     * Set the subcategory slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    function ads(): HasMany
    {
        return $this->hasMany(Ad::class, 'subcategory_id');
    }

    public function childCategory():HasMany
    {
        return $this->hasMany(ChildCategory::class,'sub_category_id','id');
    }

    public function size():HasMany
    {
        return $this->hasMany(AdsSize::class,'sub_category_id','id');
    }
    public function product():HasMany
    {
        return $this->hasMany(Ad::class,'subcategory_id','id');
    }

    public function available_product() {
        return $this->product()->where('status', '!=', 'pending')->where('validity', '>', now());
    }
}
