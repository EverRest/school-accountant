<?php
declare(strict_types=1);
namespace App\Livewire;

use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class Welcome extends Component
{
    /**
     * @return Application|Redirector|string|RedirectResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function render()
    {
        return <<<'HTML'
        <div>
            Hello :)
        </div>
        HTML;
    }
}
