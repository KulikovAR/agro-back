<?php

namespace App\Http\Controllers\V1;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Role;
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
        $contact = $updateHook->getMessage();
        $phone_number = $contact->getPhoneNumber();
        $username = $contact->getFrom()->getUsername();
        $chatId = $contact->getChat()->getId();
        Storage::put('test.txt', $contact);
        if(isset($contact->contact))
        {
            $contact = $contact->getContact();

            $user = User::where('phone_number', $phone_number)->exist();
            $logistcianRole = Role::where('name',RoleEnum::LOGISTICIAN->value)->first();
            if($user && $user->hasRole($logistcianRole)){
                $tgUser = TgUser::create(['phone_number' => $phone_number, 'username' => $username, 'user_id' => $user->id, 'chat_id' => $chatId ]);
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Спасибо, вам будут приходить уведомления об откликах на заявки созданные вами',
                    'reply_markup' => $reply_markup
                ]);
                return 1;
            }
            else{
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Вы не зарегистрированы в AgroLogistic или не являетесь логистом AgroLogistic',
                    'reply_markup' => $reply_markup
                ]);
                return 1;
            }
        }
        Storage::put('test.txt', $contact);
        if($contact->text != '/start'){
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Вы не прислали номер телефона',
                'reply_markup' => $reply_markup
            ]);
            return 1;
        }
        return 1;

    }


}
