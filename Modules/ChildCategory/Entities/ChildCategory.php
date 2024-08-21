<?php

namespace Modules\ChildCategory\Entities;

use App\Models\AdsSize;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Ad\Entities\Ad;
use Modules\Category\Entities\SubCategory;

class ChildCategory extends Model
{

    use HasFactory;

    protected $fillable = [
        'sub_category_id',
        'name',
        'slug',
    ];

    protected static function newFactory()
    {
        return \Modules\ChildCategory\Database\factories\ChildCategoryFactory::new();
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

    public function subcategory():BelongsTo
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

    public function product():HasMany
    {
        return $this->hasMany(Ad::class,'child_category_id','id');
    }

    public function size():HasMany
    {
        return $this->hasMany(AdsSize::class);
    }

    public function available_product() {
        return $this->product()->where('status', '!=', 'pending')->where('validity', '>', now());
    }
}
