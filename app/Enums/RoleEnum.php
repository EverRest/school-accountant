<?php
declare(strict_types=1);
namespace App\Enums;

use App\Enums\Traits\EnumToArray;

enum RoleEnum: string
{
    use EnumToArray;
    case Owner = 'owner';
    case Administrator = 'administrator';
    case Teacher = 'teacher';
    case Student = 'student';
}
