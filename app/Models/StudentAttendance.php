<?php

namespace App\Models;

use App\Traits\Models\LessonTrait;
use App\Traits\Models\StudentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAttendance extends Model
{
    use HasFactory;
    use LessonTrait;
    use StudentTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'lesson_id',
        'student_id',
        'student_package_id',
        'fee',
        'is_present',
    ];

    /**
     * @return BelongsTo
     */
    public function studentPackage(): BelongsTo
    {
        return $this->belongsTo(StudentPackage::class);
    }
}
