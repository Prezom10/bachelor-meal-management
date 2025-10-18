<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Meal;

class MealApprovedAlert extends Notification
{
    use Queueable;

    public $meal;

    /**
     * Create a new notification instance.
     */
    public function __construct(Meal $meal)
    {
        $this->meal = $meal;
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
                    ->subject('Your Meal Entry Has Been Approved!')
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('Your meal entry for ' . $this->meal->date . ' has been approved by the admin.')
                    ->line('Lunch: ' . $this->meal->lunch . ', Dinner: ' . $this->meal->dinner)
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
            'meal_id' => $this->meal->id,
            'date' => $this->meal->date,
            'message' => 'Your meal entry for ' . $this->meal->date . ' has been approved.',
        ];
    }
}