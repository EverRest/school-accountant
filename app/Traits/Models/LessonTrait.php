<?php
declare(strict_types=1);
namespace App\Traits\Models;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait LessonTrait
{
    /**
     * @return BelongsTo
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
