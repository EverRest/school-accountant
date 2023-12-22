<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Course;

class CourseService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = Course::class;
}
