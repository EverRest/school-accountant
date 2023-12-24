<?php
declare(strict_types=1);
namespace App\Traits\Models;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TeacherTrait
{
    /**
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
