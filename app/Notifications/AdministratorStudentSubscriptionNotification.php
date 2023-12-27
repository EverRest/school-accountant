<?php
declare(strict_types=1);
namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;

class AdministratorStudentSubscriptionNotification extends StudentSubscriptionNotification
{
    use Queueable;

    public function __construct(private readonly User $user)
    {
    }

    /**
     * @return string
     */
    protected function getMessage(): string
    {
        return "Student {$this->user?->name} is out of subscription.";
    }
}
