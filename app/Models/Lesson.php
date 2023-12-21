<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\CreatorTrait;
use App\Traits\Models\TeacherTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;
    use CreatorTrait;
    use TeacherTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'creator_id',
        'group_id',
        'teacher_id',
        'teacher_salary',
        'date',
    ];

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
