<?php
declare(strict_types=1);
namespace App\Observers;

use App\Events\StudentAppliedToLesson;
use App\Models\StudentAttendance;

class StudentAttendanceObserver
{
    /**
     * Handle the StudentAttendance "created" event.
     */
    public function created(StudentAttendance $studentAttendance): void
    {
        StudentAppliedToLesson::dispatch($studentAttendance->id);
    }
}
