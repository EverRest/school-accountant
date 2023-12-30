<?php
declare(strict_types=1);
namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait                                                                                                                HasPublicPhotoAttributeTrait
{
    /**
     * @return Attribute
     */
    public function photo(): Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => $this->avatar ? "storage/$this->avatar" : '');
    }
}
