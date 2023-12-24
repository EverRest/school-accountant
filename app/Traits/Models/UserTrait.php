<?php
declare(strict_types=1);
namespace App\Traits\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserTrait
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return Attribute
     */
    public function userName(): Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => $this->user->name ?? '');
    }

    /**
     * @return Attribute
     */
    public function userEmail(): Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => $this->user->name ?? '');
    }
}
