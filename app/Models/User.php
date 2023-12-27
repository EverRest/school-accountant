<?php
declare(strict_types=1);
namespace App\Models;

use App\Traits\Models\HasPublicPhotoAttributeTrait;
use App\Traits\Models\StudentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use StudentTrait;
    use HasPublicPhotoAttributeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @param $query
     * @param string $roles
     *
     * @return mixed
     */
    public function scopeRole($query, string $roles): mixed
    {
        return $query->whereHas(
            'roles',
            fn($q) => $q->where(['name' => $roles])
        );
    }

    /**
     * @return HasOne
     */
    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }
}
