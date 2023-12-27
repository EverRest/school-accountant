<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\CreatorTrait;
use App\Traits\Models\HasPublicPhotoAttributeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    use CreatorTrait;
    use HasPublicPhotoAttributeTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'creator_id',
        'name',
        'avatar',
    ];

    /**
     * @return HasMany
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
