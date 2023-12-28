<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Telegram\Bot\Laravel\Facades\Telegram;
class ApplierBotController extends Controller
{
    /**
     * @return void
     */
    public function __invoke(): void
    {
        $update = Telegram::commandsHandler(true);
        dd($update);
    }
}
