<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\TgUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $updateHook = Telegram::getWebhookUpdates();
        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->row([
                Keyboard::button(['text' => 'Отправьте свой телефон', 'request_contact' => true])
            ]);
        $contact = $update->getMessage();
        if(isset($contact->contact))
        {
            $contact = $contact->getContact();
            $phone_number = $contact->getPhoneNumber();
            $username = $contact->getFrom()->getUsername();
            $chatId = $contact->getChat()->getId();
            $user = User::where('phone_number', $phone_number)->exist();
            if($user){
                $tgUser = TgUser::create(['phone_number' => $phone_number, 'username' => $username, 'user_id' => $user->id, 'chat_id' => $chatId ]);
            }
            else{
                Telegram::sendMessage([
                    'chat_id' => 562494573,
                    'text' => 'Вы не зарегистрированы в AgroLogistic',
                    'reply_markup' => $reply_markup
                ]);
                return 1;
            }
            $data = Storage::put('test.txt', $phone_number);
            Telegram::sendMessage([
                'chat_id' => 562494573,
                'text' => 'Спасибо',
                'reply_markup' => $reply_markup
            ]);
            return 1;
        }
        if($contact->text != '/start'){
            Telegram::sendMessage([
                'chat_id' => 562494573,
                'text' => 'Вы не прислали номер телефона',
                'reply_markup' => $reply_markup
            ]);
            return 1;
        }
        return 1;

    }


}
