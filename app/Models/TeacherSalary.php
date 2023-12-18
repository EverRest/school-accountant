<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\LessonTrait;
use App\Traits\Models\TeacherTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSalary extends Model
{
    use HasFactory;
    use TeacherTrait;
    use LessonTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'lesson_id',
        'teacher_id',
        'salary',
    ];
}
