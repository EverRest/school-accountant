<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\CourseTrait;
use App\Traits\Models\CreatorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    use CreatorTrait;
    use CourseTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'creator_id',
        'course_id',
        'name',
    ];
}
