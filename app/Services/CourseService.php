<?php
declare(strict_types=1);
namespace App\Services;

class CourseService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = 'App\Models\Course';
}
