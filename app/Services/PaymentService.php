<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Payment;

class PaymentService extends AbstractCRUDService
{
    /**
     * @var string
     */
    protected string $model = Payment::class;
}
