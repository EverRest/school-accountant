<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
