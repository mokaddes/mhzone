<?php

namespace App\Http\Traits;

use App\Models\User;
use App\Models\Setting;
use App\Models\UserPlan;
use App\Models\Transaction;
use App\Notifications\MembershipUpgradeNotification;

trait PaymentTrait
{
    public function orderPlacing($redirect = true)
    {
        // fetch session data
        $plan = session('plan');
        $order_amount = session('order_payment');
        $transaction_id = session('transaction_id') ?? uniqid('tr_');

        // Plan benefit attach to user

        // Transaction create
        Transaction::create([
            'order_id' => rand(1000, 999999999),
            'transaction_id' =>  $transaction_id,
            'coupon_id' => $plan->id,
            'coupons' => $plan->coupons,
            'user_id' => auth('user')->id(),
            'payment_provider' => $order_amount['payment_provider'],
            'amount' => $order_amount['amount'],
            'currency_symbol' => $order_amount['currency_symbol'],
            'usd_amount' => $order_amount['usd_amount'],
            'payment_status' => 'paid',
        ]);

        $this->userPlanInfoUpdate($plan);
        // Store plan benefit in session and forget session
        storePlanInformation();
        $this->forgetSessions();

        // create notification and send mail to customer
        if (checkMailConfig()) {
            $user = auth('user')->user();
            if (checkSetup('mail')) {
                $user->notify(new MembershipUpgradeNotification($user, $plan->coupons));
            }
        }

        // redirect to customer billing
        if ($redirect) {
            session()->flash('success', 'Coupon purchased successfully');
            return redirect()->route('frontend.coupons')->send();
        }
    }

    private function forgetSessions()
    {
        session()->forget('plan');
        session()->forget('order_payment');
        session()->forget('transaction_id');
        session()->forget('stripe_amount');
        session()->forget('razor_amount');
    }


    /**
     * Update userplan information.
     *
     * @param Plan $plan
     * @return boolean
     */
    public function userPlanInfoUpdate($plan)
    {

        $user = User::find(auth('user')->id());
        $user->coupons = $user->coupons + $plan->coupons;
        $user->save();

        return true;
    }

    /**
     * Create a new transaction instance.
     *
     * @param string $order_id
     * @param string $payment_provider
     * @param int $payment_amount
     * @param int $plan_id
     *
     * @return boolean
     */
    public function createTransaction(string $order_id, string $payment_provider, int $payment_amount, int $plan_id)
    {
        Transaction::create([
            'order_id' => $order_id,
            'user_id' => auth('user')->id(),
            'plan_id' => $plan_id,
            'payment_provider' => $payment_provider,
            'amount' => $payment_amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
