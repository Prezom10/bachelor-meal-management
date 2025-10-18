<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Market;

class MarketApprovedAlert extends Notification
{
    use Queueable;

    public $market;

    /**
     * Create a new notification instance.
     */
    public function __construct(Market $market)
    {
        $this->market = $market;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Your Market Entry Has Been Approved!')
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('Your market entry for ' . $this->market->date . ' with amount ' . $this->market->amount . ' has been approved by the admin.')
                    ->action('View Your Dashboard', url('/user/dashboard'))
                    ->line('Thank you for using our service!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'market_id' => $this->market->id,
            'date' => $this->market->date,
            'message' => 'Your market entry for ' . $this->market->date . ' has been approved.',
        ];
    }
}