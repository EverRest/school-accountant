<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Group;

class GroupService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = Group::class;
}
