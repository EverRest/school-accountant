<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    use UserTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'parent',
    ];

    /**
     * @return BelongsTo
     */
    public function studentAttendances(): BelongsTo
    {
        return $this->belongsTo(StudentAttendance::class);
    }

    /**
     * @return HasMany
     */
    public function studentPackages(): HasMany
    {
        return $this->hasMany(StudentPackage::class);
    }
}
