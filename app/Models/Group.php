<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\CourseTrait;
use App\Traits\Models\CreatorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Group extends Model
{
    use HasFactory;
    use CreatorTrait;
    use CourseTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'creator_id',
        'course_id',
        'name',
    ];

    /**
     * @return HasManyThrough
     */
    public function teachers(): HasManyThrough
    {
        return $this->hasManyThrough(
            Teacher::class,
            GroupTeacher::class,
            'group_id',
            'id',
            'id',
            'teacher_id'
        );
    }

    /**
     * @return HasManyThrough
     */
    public function students(): HasManyThrough
    {
        return $this->hasManyThrough(
            Student::class,
            GroupTeacher::class,
            'group_id',
            'id',
            'id',
            'student_id'
        );
    }
}
