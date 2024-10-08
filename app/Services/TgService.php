<?php

namespace App\Services;

use App\Models\TgUser;
use App\Models\User;
use Telegram\Bot\Laravel\Facades\Telegram;

class TgService
{
    public static function notifyUser(User $user, string $text): void
    {
        $tgUser = TgUser::where('user_id', $user->id)->first();
        if (is_null($tgUser)) {
            return;
        }
        Telegram::sendMessage([
            'chat_id' => $tgUser->chat_id,
            'text' => $text,
        ]);
    }
}
