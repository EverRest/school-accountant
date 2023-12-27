<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\CourseTrait;
use App\Traits\Models\CreatorTrait;
use App\Traits\Models\HasPublicPhotoAttributeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;
    use CreatorTrait;
    use CourseTrait;
    use HasPublicPhotoAttributeTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'creator_id',
        'course_id',
        'name',
        'avatar',
    ];

    /**
     * @return BelongsToMany
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'group_teacher');
    }

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'group_student');
    }
}
