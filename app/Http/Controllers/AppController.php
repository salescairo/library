<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
class AppController extends Controller
{
    public function home(): RedirectResponse|View
    {
        return auth()->check()
            ? view(view: 'home')
            : redirect()->route(route: 'login');
    }
}
