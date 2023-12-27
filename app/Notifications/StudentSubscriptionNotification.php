<?php
declare(strict_types=1);
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class StudentSubscriptionNotification extends Notification
{
    use Queueable;

    /**
     * @param $notifiable
     *
     * @return string[]
     */
    public function via($notifiable): array
    {
        return ['vonage', 'mail', 'database',];
    }

    /**
     * @param $notifiable
     *
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line($this->getMessage());
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     */
    public function toVonage(object $notifiable): VonageMessage
    {
        return (new VonageMessage)
            ->content($this->getMessage());
    }

    /**
     * @return string
     */
    protected function getMessage(): string
    {
        return 'You\'re package is empty. Please buy new package to continue.';
    }
}
