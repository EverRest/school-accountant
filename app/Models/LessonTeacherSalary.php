<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\TeacherTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonTeacherSalary extends Model
{
    use HasFactory;
    use TeacherTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'lesson_id',
        'teacher_id',
        'salary',
    ];

    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
