<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->route('user.login')->with('error', 'User not found');
        }
        $socialiteUserId = $socialiteUser->getId();
        $socialiteUserName = $socialiteUser->getName();
        $socialiteUseremail = $socialiteUser->getEmail();

        $user = User::where('provider', $provider)
            ->where('provider_id', $socialiteUserId)->first();

        if (!$user) {

            if ($socialiteUseremail) {
                $validator = Validator::make(
                    ['email' => $socialiteUseremail],
                    ['email' => ['unique:users,email']],
                    ['email.unique' => 'Couldn\'t login. Maybe you used a different login method?'],
                );

                if ($validator->fails()) {
                    return redirect()->route('user.login')->withErrors($validator);
                }
            }
            $name = $this->split_name($socialiteUserName);
            $username = $name[0] . '_' . random_int(1111, 9999);
            $user = User::create([
                'name' => $socialiteUserName,
                'email' => $socialiteUseremail,
                'username' => $username,
                'provider' => $provider,
                'provider_id' => $socialiteUserId,
                'email_verified_at' => Carbon::now(),
            ]);
        }

        Auth::guard('user')->login($user);

        return redirect()->route('frontend.user.profile');
    }

    function split_name($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array($first_name, $last_name);
    }
}
