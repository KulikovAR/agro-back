<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Keyboard\Keyboard;

class TgBotController extends Controller
{

    public function update()
    {
        $updates = Telegram::getWebhookUpdate();
        return (json_encode($updates));
    }
    public function sendMessage()
    {
        $update = Telegram::commandsHandler(true);
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->row([
                Keyboard::button('Отправить номер телефона')
                ->setRequestContact(true),
            ]);
        Telegram::sendMessage([
            'chat_id' => 562494573,
            'reply_markup' => $reply_markup
        ]);
    return 1;
    }
}
