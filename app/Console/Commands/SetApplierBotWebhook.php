<?php
declare(strict_types=1);
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class SetApplierBotWebhook extends Command
{
    /**
     * @var string
     */
    protected $signature = 'telegram:webhook:set';

    /**
     * @var string
     */
    protected $description = 'Set the Telegram bot webhook';

    /**
     * @return void
     */
    public function handle(): void
    {
        $url = route('applier-bot.invoke');
        Telegram::setWebhook(['url' => $url]);
        $this->info('Webhook set successfully');
    }
}
