<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
class SaleController extends Controller
{
    public function index(): View
    {
        return view(view: 'model.sale.index');
    }
}
