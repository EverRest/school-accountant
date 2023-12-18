<?php
declare(strict_types=1);
namespace App\Services;

class PaymentService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = 'App\Models\Payment';
}
