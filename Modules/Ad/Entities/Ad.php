<?php

namespace Modules\Ad\Entities;

use App\Models\AdsAttr;
use App\Models\User;
use App\Models\Color;
use App\Models\Order;
use App\Models\AdsSize;
use App\Models\AdsTags;
use App\Models\Department;
use App\Models\ItemPurchase;
use Modules\Brand\Entities\Brand;
use Modules\Ad\Entities\AdFeature;
use Modules\Review\Entities\Review;
use App\Models\Admin\ShipingLocations;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Wishlist\Entities\Wishlist;
use Modules\Category\Entities\SubCategory;
use Modules\Ad\Database\factories\AdFactory;
use Modules\CustomField\Entities\CustomField;
use Modules\ChildCategory\Entities\ChildCategory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\CustomField\Entities\ProductCustomField;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Ad extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $appends = ['image_url'];
    protected $casts = ['wishlisted' => 'boolean', 'show_phone' => 'boolean'];
    protected static function newFactory()
    {
        return AdFactory::new();
    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->thumbnail)) {
            return asset('backend/image/default-ad.png');
        }

        return asset($this->thumbnail);
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
     *  Active ad scope
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')->where('qty', '>', 0);
    }
    public function scopeValidate($query)
    {
        return $query->where('validity', '>', now());
    }

    /**
     *  Active Category scope
     * @return mixed
     */
    public function scopeActiveCategory($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('status', 1);
        });
    }

    /**
     *  Active Category scope
     * @return mixed
     */
    public function scopeActiveSubcategory($query)
    {
        return $query->whereHas('subcategory', function ($q) {
            $q->where('status', 1);
        });
    }

    /**
     *  Inactive Category scope
     * @return mixed
     */
    public function scopeInactiveCategory($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('status', 0);
        });
    }


    /**
     *  BelongTo
     * @return BelongsTo|Collection|Category[]
     */
    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     *  BelongTo
     * @return BelongsTo|Collection|Category[]
     */
    function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }
    /**
     *  BelongTo
     * @return BelongsTo|Collection|Category[]
     */
    function childcategory(): BelongsTo
    {
        return $this->belongsTo(ChildCategory::class,'child_category_id','id');
    }

    /**
     *  BelongTo
     * @return BelongsTo|Collection|Customer[]
     */
    function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     *  Has Many
     * @return HasMany|Collection|AdGallery[]
     */
    function galleries(): HasMany
    {
        return $this->hasMany(AdGallery::class, 'ad_id');
    }
    function attrs(): HasMany
    {
        return $this->hasMany(AdsAttr::class, 'ad_id');
    }


    /**
     *  BelongTo
     * @return BelongsTo|Collection|Customer[]
     */
    function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'ad_id');
    }

    public function adFeatures()
    {
        return $this->hasMany(AdFeature::class, 'ad_id');
    }

    public function productCustomFields()
    {
        return $this->hasMany(ProductCustomField::class, 'ad_id')->oldest('order')->with('customField.values', 'customField.customFieldGroup');
    }

    public function adSize():HasOne
    {
        return $this->hasOne(AdsSize::class,'id','size_id');
    }

    public function adColor():HasOne
    {
        return $this->hasOne(Color::class,'id','color');
    }

    public function adTags():HasMany
    {
        return $this->hasMany(AdsTags::class,'ad_id','id');
    }

    public function adCountry():HasOne
    {
        return $this->hasOne(ShipingLocations::class,'id','country');
    }


    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class,'ad_id','id');
    }

    public function review():HasMany
    {
        return $this->hasMany(Review::class,'id','item_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

}
