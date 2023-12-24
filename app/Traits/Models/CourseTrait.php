<?php
declare(strict_types=1);
namespace App\Traits\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CourseTrait
{
    /**
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
