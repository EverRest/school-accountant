<?php
declare(strict_types=1);
namespace App\Traits\Models;

use App\Models\StudentPackage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait StudentTrait
{
    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(StudentPackage::class);
    }
}
