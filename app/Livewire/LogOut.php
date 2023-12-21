<?php
declare(strict_types=1);

namespace App\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogOut
{
    /**
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function __invoke(): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();

        return redirect(route('login'));
    }
}
