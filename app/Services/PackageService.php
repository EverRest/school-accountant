<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Package;

class PackageService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = Package::class;
}
