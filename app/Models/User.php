<?php

namespace App\Models;

use App\Models\Admin\ShipingLocations;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyApiEmailInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Modules\Ad\Entities\Ad;
use Modules\PushNotification\Entities\UserDeviceToken;
use Modules\Review\Entities\Review;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyApiEmailInterface
{
    use HasFactory, Notifiable, MustVerifyEmail;

    protected $guarded = [];

    protected $appends = ['image_url'];
    protected $guard = 'user';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
//    protected static function booted()
//    {
//        static::created(function ($customer) {
//            $setting = Setting::first();
//            $customer->userPlan()->create([
//                'ad_limit'  =>  $setting->free_ad_limit,
//                'featured_limit'  =>  $setting->free_featured_ad_limit,
//                'subscription_type' => $setting->subscription_type,
//            ]);
//        });
//    }

    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return asset('backend/image/default-user.png');
        }

        return asset($this->image);
    }

    /**
     *  HasMany
     * @return HasMany|Collection|Customer
     */
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * User Pricing Plan
     *
     * @return HasOne
     *
     */
    public function userPlan(): HasOne
    {
        return $this->hasOne(UserPlan::class);
    }

    public function userShop(): HasOne
    {
        return $this->hasOne(UserShop::class);
    }

    /**
     * User Transactions
     *
     * @return HasMany
     */
    public function userTransactions(): HasMany
    {
        if ($this->user_mode == 0) {
            return $this->hasMany(Transaction::class, 'user_id', 'id');
        } else {
            return $this->hasMany(TransactionDetails::class, 'seller_id', 'id');
        }
    }

    /**
     * User Transactions
     *
     * @return HasMany
     */
    public function completeTransactions(): HasMany
    {
        return $this->hasMany(ItemPurchase::class, 'created_by', 'id')->where('item_purchases.status', '=', 5);
    }


    public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class, 'user_id');
    }

    public function deviceToken()
    {
        return $this->hasMany(UserDeviceToken::class, 'user_id', 'id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(ShipingLocations::class, 'location', 'id');
    }


    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Ad::class, 'user_id', 'item_id');
    }


}
