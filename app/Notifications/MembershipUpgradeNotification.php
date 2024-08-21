<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipUpgradeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $user, $coupons;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $coupons)
    {
        $this->user = $user;
        $this->coupons = $coupons;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting("Hello " . $this->user->name . " !")
            ->subject('Coupon purchased')
            ->line("Purchased  " . $this->coupons . " Coupons")
            ->action('View Coupons', url('dashboard/coupons'))
            ->line('Thank you for using our ' . config('app.name') . '!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'msg' => "Purchased  " . $this->coupons . " Coupons",
            'type' => 'coupon_purchased',
        ];
    }
}
