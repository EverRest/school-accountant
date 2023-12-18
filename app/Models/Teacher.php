<?php

namespace App\Models;

use App\Traits\Models\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    use UserTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'individual_salary',
        'group_salary',
    ];
}