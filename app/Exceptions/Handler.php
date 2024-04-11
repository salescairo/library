<?php

namespace App\Exceptions;

use App\Utils\Message;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use ProtoneMedia\Splade\Facades\Toast;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(\ProtoneMedia\Splade\SpladeCore::exceptionHandler($this));

        $this->reportable(function (Throwable $e) {
        });
        $this->reportable(function (EntityNotFoundException $e) {
            Message::danger(message: $e->getMessage());
        });
    }
}
