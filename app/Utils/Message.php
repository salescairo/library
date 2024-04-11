<?php

namespace App\Utils;

use ProtoneMedia\Splade\Facades\Toast;

class Message
{
    public static function success(
        string $title = "Tudo certo!",
        string $message = "Operação concluída com sucesso"
    ): void {
        Toast::success()
            ->title($title)
            ->message($message)
            ->centerBottom()
            ->autoDismiss(afterSeconds: 20);
    }

    public static function danger(
        string $title = "Ops",
        string $message = "Falha ao concluir a operação"
    ): void {
        Toast::danger()
            ->title($title)
            ->message($message)
            ->centerBottom()
            ->autoDismiss(afterSeconds: 20);
    }
}