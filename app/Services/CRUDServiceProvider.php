<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\ServiceProvider;

class CRUDServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '../config/pagination.php' => config_path('pagination.php'),
            __DIR__ . '../config/multiple-languages-fields.php' => config_path('multiple-languages-fields.php'),
        ]);
    }
}
