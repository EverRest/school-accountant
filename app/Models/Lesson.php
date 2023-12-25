<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\CreatorTrait;
use App\Traits\Models\TeacherTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;
    use CreatorTrait;
    use TeacherTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'creator_id',
        'group_id',
        'teacher_id',
        'date',
    ];

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @return HasMany
     */
    public function studentAttendances(): HasMany
    {
        return $this->hasMany(StudentAttendance::class);
    }
}
