<?php

namespace App\Models;

use App\Traits\Models\CreatorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    use CreatorTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'creator_id',
        'name',
        'count_lessons',
        'price',
    ];
}
