<?php

namespace App\Models;

use App\Traits\Models\CreatorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use CreatorTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'creator_id',
        'name',
    ];
}
