<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\StudentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentPackage extends Model
{
    use HasFactory;
    use StudentTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'student_id',
        'package_id',
        'price',
    ];

    /**
     * @return BelongsTo
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
