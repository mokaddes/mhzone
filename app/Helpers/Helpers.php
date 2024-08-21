<?php


use Stripe\Token;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Setting;
use App\Models\UserPlan;
use Modules\Ad\Entities\Ad;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Modules\Category\Entities\Category;
use Modules\Language\Entities\Language;
use Modules\Wishlist\Entities\Wishlist;
use App\Notifications\LoginNotification;
use Modules\SetupGuide\Entities\SetupGuide;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Modules\Currency\Entities\Currency as CurrencyModel;

function setting($fields = null, $append = false)
{
    if ($fields) {
        $type = gettype($fields);

        if ($type == 'string') {
            $data = $append ? Setting::first($fields) : Setting::value($fields);
        } elseif ($type == 'array') {
            $data = Setting::first($fields);
        }
    } else {
        $data = Setting::first();
    }

    if ($append) {
        $data = $data->makeHidden(['logo_image_url', 'logo2_image_url', 'favicon_image_url', 'loader_image_url']);
    }

    return $data;
}

/**
 * Check ad is wishlisted
 *
 * @param integer $adId
 * @return boolean
 */
// function isWishlisted($adId)
// {
//     if (auth()->guard('user')->check() && session()->has('wishlists') && in_array($adId, session('wishlists'))) {
//         return true;
//     }

//     return false;
// }

/**
 * Store customer plan information to session storage
 *
 * @return void
 */
function storePlanInformation()
{
    session()->forget('user_plan');
    // session()->put('user_plan', auth()->guard('user')->user()->userPlan);
}

function socialMediaShareLinks(string $path, string $provider)
{
    switch ($provider) {
        case 'facebook':
            $share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $path;
            break;
        case 'twitter':
            $share_link = 'https://twitter.com/intent/tweet?text=' . $path;
            break;
        case 'linkedin':
            $share_link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $path;
            break;
        case 'gmail':
            $share_link = 'https://mail.google.com/mail/u/0/?ui=2&fs=1&tf=cm&su=' . $path;
            break;
        case 'whatsapp':
            $share_link = 'https://wa.me/?text=' . $path;
            break;
    }

    return $share_link;
}


/**
 * Get is category menu selected
 *
 * @param Category $category
 *
 * @return boolean
 */
function isActiveCategorySidebar($category)
{
    $found = false;

    $categorySubcatategories = $category->subcategories->pluck('slug')->all();
    $urlSubCategories = request('subcategory', []);

    foreach ($categorySubcatategories as $category) {
        if (in_array($category, $urlSubCategories)) {
            $found = true;
            break;
        }
    }

    return $found;
}

function isActiveSubCategorySidebar($subCategory, $category)
{
    $found = false;

    $categoryChildcatategories = $subCategory->childCategory->pluck('slug')->all();
    $urlChildCategories = request('childcategory', []);

    $url = url()->current();
    $url_components = parse_url($url);
    $path_parts = explode('/', $url_components['path']);
    if (isset($path_parts[2])) {
        $url_cat = $path_parts[2];
    } else {
        $url_cat = null;
    }


    if (is_array($urlChildCategories)) {

        foreach ($categoryChildcatategories as $subcategory) {
            if (in_array($subcategory, $urlChildCategories) && $category == $url_cat) {
                $found = true;
                break;
            }
        }
    } else {
        if ($subCategory == $urlChildCategories && $category == $url_cat) {
            $found = true;
        } else {
            $found = false;
        }
    }

    return $found;
}

function isActiveSubCategorySidebarDashboard($subCategory, $category)
{
    $found = false;

    $categoryChildcatategories = $subCategory->childCategory->pluck('slug')->all();
    $urlChildCategories = request('childcategory', []);

    $url = url()->current();
    $url_components = parse_url($url);
    $path_parts = explode('/', $url_components['path']);
    if (isset($path_parts[3])) {
        $url_cat = $path_parts[3];
    } else {
        $url_cat = null;
    }


    if (is_array($urlChildCategories)) {

        foreach ($categoryChildcatategories as $subcategory) {
            if (in_array($subcategory, $urlChildCategories) && $category == $url_cat) {
                $found = true;
                break;
            }
        }
    } else {
        if ($subCategory == $urlChildCategories && $category == $url_cat) {
            $found = true;
        } else {
            $found = false;
        }
    }

    return $found;
}

function isActiveChildCategorySidebarDashboard($childCategory, $category)
{
    $found = false;
    $urlChildCategories = request('childcategory', []);
    $url = url()->current();
    $url_components = parse_url($url);
    $path_parts = explode('/', $url_components['path']);
    if (isset($path_parts[3])) {
        $url_cat = $path_parts[3];
    } else {
        $url_cat = null;
    }


    if ($childCategory == $urlChildCategories && $category == $url_cat) {
        $found = true;
    }

    if (is_array($urlChildCategories)) {
        if (in_array($childCategory, $urlChildCategories) && $category == $url_cat) {
            $found = true;
        }
    }
    return $found;
}

function isActiveChildCategorySidebar($childCategory, $category)
{
    $found = false;
    $urlChildCategories = request('childcategory', []);
    $url = url()->current();
    $url_components = parse_url($url);
    $path_parts = explode('/', $url_components['path']);
    if (isset($path_parts[2])) {
        $url_cat = $path_parts[2];
    } else {
        $url_cat = null;
    }


    if ($childCategory == $urlChildCategories && $category == $url_cat) {
        $found = true;
    }

    if (is_array($urlChildCategories)) {
        if (in_array($childCategory, $urlChildCategories) && $category == $url_cat) {
            $found = true;
        }
    }
    return $found;
}


function isActiveSize($size_id)
{
    $found = false;
    $urlSize = request('size', []);

    if (in_array($size_id, $urlSize)) {
        $found = true;
    }

    return $found;
}

function sizeSubCategoryActive($subcategories)
{

    $found = false;

    $urlSize = request('size', []);
    $psubCategorySizes = $subcategories->size;

    foreach ($psubCategorySizes as $size) {
        if (in_array($size->id, $urlSize)) {
            $found = true;
        }
    }
    return $found;
}


function activeConditions($conditions)
{


    $urlConditions = request('conditions', []);

    if (in_array($conditions, $urlConditions)) {

        return true;
    } else {
        Log::alert(false);

        return false;
    }
}


function activeCountry($country)
{
    $urlCountry = request('country', []);


    if (in_array($country, $urlCountry)) {

        return true;
    } else {


        return false;
    }
}


function countByCondition($conditions)
{

    return Ad::where('status', '!=', 'pending')->where('validity', '>', now())->where('condition', $conditions)->count();
}


// function homePageThemes()
// {
//     return Theme::first()->home_page;
// }

function collectionToResource($data)
{
    return json_decode(json_encode($data), false);
}

/**
 * Store customer wishlists information to session storage
 *
 * @return void
 */
function resetSessionWishlist()
{
    session()->forget('wishlists');
    $wishlists = Wishlist::select(['ad_id'])->where('user_id', auth()->guard('user')->id())->pluck('ad_id')->all();

    session()->put('wishlists', $wishlists);
}

/**
 * Send logged in notification
 *
 * @return void
 */
function loggedinNotification()
{
    $user = User::find(auth('user')->id());
    if (checkSetup('mail')) {
        $user->notify(new LoginNotification($user));
    }
}

/**
 * customer has mambership badge or not
 *
 * @param int $user_id
 * @return bool
 */
function hasMemberBadge($user_id)
{
    return UserPlan::where('user_id', $user_id)->first()->badge;
}

/**
 * user permission check
 *
 * @param string $permission
 * @return boolean
 */
function userCan($permission)
{
    if (auth('admin')->check()) {
        return auth('admin')->user()->can($permission);
    }

    return false;
}

/**
 * user permission check
 *
 * @param string $permission
 * @return boolean
 */
function envReplace($name, $value)
{
    $path = base_path('.env');
    if (file_exists($path)) {
        file_put_contents($path, str_replace(
            $name . '=' . env($name),
            $name . '=' . $value,
            file_get_contents($path)
        ));
    }

    if (file_exists(App::getCachedConfigPath())) {
        Artisan::call("config:cache");
    }
}

function langDirection()
{
    $lang_code = app()->getLocale();
    $lang_direction = Language::where('code', $lang_code)->value('direction');

    return $lang_direction;
}

function error($name)
{
    $errors = session()->get('errors', app(ViewErrorBag::class));

    return $errors->has($name) ? 'is-invalid' : '';
}

function convertCurrency($amount, $last_digit = 2)
{
    if ($amount) {
        $amount = CurrencyModel::where('code', config('adlisting.currency'))->value('exchange_rate') * $amount;
    }

    return number_format($amount, $last_digit, '.', ',');
}

function convertCurrency2($amount)
{
    return (int)Currency::convert()
        ->from('USD')
        ->to(config('adlisting.currency'))
        ->amount($amount)
        ->round(2)
        ->get();
}

function currencyFormatting($amount)
{
    $currency = session('current_currency');
    $converted_amount = $amount;

    if ($currency->symbol_position == 'left') {
        return "$currency->symbol$converted_amount";
    } else {
        return "$converted_amount$currency->symbol";
    }
}

function changeCurrency($amount)
{

    $defualt_currency = DB::table('currencies')->where('default_currencies', 1)->first();

    $symbol = $defualt_currency->symbol;
    $position = $defualt_currency->symbol_position;

    if ($position == 'left') {
        return $symbol . ' ' . $amount;
    } else {
        return $amount . ' ' . $symbol;
    }

    return $amount;
}

function onlyCurrencySymbol()
{

    $defualt_currency = DB::table('currencies')->where('default_currencies', 1)->first();

    $symbol = $defualt_currency->symbol;

    return $symbol;

}

function getFileSize($file)
{
    $file_exists = file_exists($file);

    if ($file_exists) {
        return File::size($file);
    }

    return 0;
}

function setup_guide($slug)
{
    $guide = SetupGuide::where('slug', $slug)->first();
    return $guide;
}

function setup_guides()
{
    return SetupGuide::all()->each(function ($item) {
        if ($item->slug == 'mail-setup') {
            $mail_status = env('MAIL_MAILER') && env('MAIL_HOST') && env('MAIL_PORT') && env('MAIL_USERNAME') && env('MAIL_PASSWORD') && env('MAIL_ENCRYPTION') && env('MAIL_FROM_ADDRESS') && env('MAIL_FROM_NAME');

            $item->status = $mail_status ? 1 : 0;
        } elseif ($item->slug == 'payment-setup') {
            $payment_settings = PaymentSetting::first();

            $payment_status = $payment_settings->paypal || $payment_settings->stripe || $payment_settings->razorpay || $payment_settings->paystack || $payment_settings->ssl_commerz;


            $item->status = $payment_status ? 1 : 0;
        }
    });
}

function checkSetup($type)
{
    switch ($type) {
        case 'mail':
            $status = env('MAIL_MAILER') && env('MAIL_HOST') && env('MAIL_PORT') && env('MAIL_USERNAME') && env('MAIL_PASSWORD') && env('MAIL_ENCRYPTION') && env('MAIL_FROM_ADDRESS') && env('MAIL_FROM_NAME');
            break;
        case 'payment':
            $payment_settings = PaymentSetting::first();
            $status = $payment_settings->paypal || $payment_settings->stripe || $payment_settings->razorpay || $payment_settings->paystack || $payment_settings->ssl_commerz;
            break;
    }

    return $status ? 1 : 0;
}

function getPhoto($path)
{
    if ($path) {
        $ppath = public_path($path);
        if (file_exists($ppath)) {
            return asset($path);
        } else {
            return asset('uploads/no_image.png');
        }
    } else {
        return asset('uploads/no_image.png');
    }
}

function getPhotoSlider($path)
{
    if ($path) {
        $ppath = public_path($path);
        if (file_exists($ppath)) {
            return asset($path);
        } else {
            return asset('uploads/no_slider.png');
        }
    } else {
        return asset('uploads/no_slider.png');
    }
}

function getPhotoAvater($path)
{
    if ($path) {
        $ppath = public_path($path);

        // dump($ppath);

        if (file_exists($ppath)) {
            return asset($path);
        } else {
            return asset('uploads/default-user.png');
        }
    } else {
        return asset('uploads/default-user.png');
    }
}

function discount_percent($main_price, $discount_price)
{
    $discount = ($main_price - $discount_price) * 100 / $main_price;

    if (is_float($discount)) {
        $data = number_format($discount, 2);
    } else {
        $data = round($discount);
    }
    return $data;
}

function measure_scale($value, $scale)
{
    $measure = ($value * $scale);

    if (is_float($measure)) {
        $data = number_format($measure, 2);
    } else {
        $data = round($measure);
    }
    return $data;
}

function shipping_region($input = null)
{
    $output = array(
        "Latvia" => "55",
        "Lithuania" => "55",
        "Estonia" => "55",
        "Others" => "50",
    );

    if (is_null($input)) {
        return $output;
    } else {

        return $output[$input];
    }
}

function wishlist_count()
{
    $count = DB::table('wishlists')->where('user_id', auth('user')->id())->count();

    return $count;
}

function getStripeToken($card_number, $month, $year, $cvc)
{
    Stripe::setApiKey(env('STRIPE_KEY'));
    $tkn = Token::create([
        'card' => [
            'number' => $card_number,
            'exp_month' => $month,
            'exp_year' => $year,
            'cvc' => $cvc,
        ],
    ]);
    return $tkn;
}

function cardNumberFormat($creditCardNumber)
{
    $cardPattern = "";

    $numberArray = str_split($creditCardNumber);

    for ($i = 0; $i < count($numberArray); $i++) {
        if ($i > 0 && $i % 4 == 0) {
            $cardPattern .= " ";
        }
        $cardPattern .= $numberArray[$i];
    }

    return $cardPattern;

}
function is_seller($user = null)
{
    if (Auth::check() && Auth::user()->user_mode == 1) {
        return true ;
    }
    if (isset($user) && $user->user_mode == 1) {
        return true ;
    }

    return false ;

}
function discount_cal($price, $discount)
{
    return round($price - ($discount * $price)/100, 2) ;

}
function cart_total($delivery = 0)
{
    $cart =  Session::get('cart');
    $total = 0 ;
    foreach ($cart as $item) {
        $total += $item['total_price'];
    }

    if ($delivery > 0){
        $total = $total + $delivery;
    }
    return $total;

}
function cart_shipping()
{
    $cart =  Session::get('cart');
    $shipping = Setting::first()->shipping_charge;
    if ($cart) {
        $ids = array_keys($cart);
        $seller = Ad::whereIn('id', $ids)->get()->groupBy('user_id');
        $shipping_charge = $shipping * $seller->count() ;
        return $shipping_charge;

    }
    return 0;

}
function cart_seller(): int
{
    $cart =  Session::get('cart');
    if ($cart) {
        $ids = array_keys($cart);
        $seller = Ad::whereIn('id', $ids)->get()->groupBy('user_id');
        return $seller->count();

    }
    return 0;

}

function seller_shipping($total_shipping, $total_seller): int
{
    return $total_shipping / $total_seller;

}

function isWishlisted($adId)
{
    if (auth()->guard('user')->check()) {
        $data = Wishlist::where('user_id', Auth::user()->id)->pluck('ad_id')->toArray();
        if (count($data) > 0 && in_array($adId, $data)) {
            return true;
        }
    };
    return false;
}

// function resetSessionWishlist()
// {
//     session()->forget('wishlists');
//     $wishlists =  Wishlist::select(['ad_id'])->where('user_id', auth()->guard('user')->id())->pluck('ad_id')->all();
//     session()->put('wishlists', $wishlists);
// }
