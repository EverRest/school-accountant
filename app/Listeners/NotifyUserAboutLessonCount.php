<?php
declare(strict_types=1);
namespace App\Listeners;

use App\Enums\RoleEnum;
use App\Events\StudentAppliedToLesson;
use App\Models\StudentAttendance;
use App\Models\StudentPackage;
use App\Models\User;
use App\Notifications\AdministratorStudentSubscriptionNotification;
use App\Notifications\StudentSubscriptionNotification;
use App\Services\StudentAttendanceService;
use App\Services\UserService;

readonly class NotifyUserAboutLessonCount
{
    /**
     * Create the event listener.
     */
    public function __construct(private StudentAttendanceService $studentAttendanceService, private UserService $userService)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(StudentAppliedToLesson $studentAppliedToLesson): void
    {
        /**
         * @var StudentAttendance $studentAttendance
         */
        $studentAttendance = $this->studentAttendanceService->findOrFail($studentAppliedToLesson->studentAttendanceId);
        /**
         * @var StudentPackage $studentPackage
         */
        $studentPackage = $studentAttendance->studentPackage;
        if ($studentPackage) {
            $packageTotalLessonCount = $this->getPackageTotalLessonCount($studentPackage);
            $attendanceTotalLessonCount = $this->getAttendanceTotalLessonCount($studentPackage);
            if ($packageTotalLessonCount && $packageTotalLessonCount <= $attendanceTotalLessonCount) {
                /**
                 * @var User $student
                 */
                $student = $studentAttendance->student?->user;
                $student->notify(new StudentSubscriptionNotification());
                $administrators = $this->userService->getUsersByRoleCode(RoleEnum::Administrator->value);
                $administrators->each(
                    fn(User $administrator) => $administrator->notify(new AdministratorStudentSubscriptionNotification($student))
                );
            }
        }
    }

    /**
     * @param StudentPackage|null $studentPackage
     *
     * @return int
     */
    protected function getAttendanceTotalLessonCount(?StudentPackage $studentPackage): int
    {
        return $this->studentAttendanceService->query()
            ->where([
                'student_id' => $studentPackage->student?->id,
                'student_package_id' => $studentPackage->id,
                'is_present' => 1
            ])->count();
    }

    /**
     * @param StudentPackage|null $studentPackage
     *
     * @return int
     */
    protected function getPackageTotalLessonCount(?StudentPackage $studentPackage): int
    {
        if (!$studentPackage) {
            return 0;
        }

        return intval($studentPackage->package?->count_lesson);
    }
}
