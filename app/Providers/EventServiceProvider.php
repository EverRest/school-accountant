<?php
declare(strict_types=1);
namespace App\Providers;

use App\Events\StudentAppliedToLesson;
use App\Listeners\NotifyUserAboutLessonCount;
use App\Models\StudentAttendance;
use App\Observers\StudentAttendanceObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        StudentAppliedToLesson::class => [
            NotifyUserAboutLessonCount::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        StudentAttendance::observe(StudentAttendanceObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
