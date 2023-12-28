<?php
declare(strict_types=1);
namespace App\Console\Commands;

use App\Services\LessonService;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class ApplierBotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected string $signature = 'app:run-applier';

    /**
     * The console command description.
     *
     * @var string
     */
    protected string $description = 'Run applier bot';

    /**
     * @var string
     */
    protected string $name = 'applier-bot';

    /**
     * @param LessonService $lessonService
     */
    public function __construct(private readonly LessonService $lessonService)
    {
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $lessons = $this->lessonService->getTodayLessons()->pluck('name')->toArray();
        $keyboard = [];
        foreach ($lessons as $lesson) {
            $keyboard[] = [$lesson];
        }
        $reply_markup = Keyboard::make([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);
        $this->replyWithMessage([
            'text' => 'Choose a lesson:',
            'reply_markup' => $reply_markup
        ]);
    }
}
