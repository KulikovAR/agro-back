<?php

namespace App\Http\Controllers\V1;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\TgUser;
use App\Models\User;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TgBotController extends Controller
{
    public function update()
    {
        $updates = Telegram::getWebhookUpdate();

        return json_encode($updates);
    }

    public function sendMessage()
    {
        Telegram::commandsHandler(true);

        $updateHook = Telegram::getWebhookUpdates();

        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->row([
                Keyboard::button(['text' => 'Отправьте свой телефон', 'request_contact' => true]),
            ]);
        $contact = $updateHook->getMessage();
        $username = $contact->getFrom()->getUsername();
        $chatId = $contact->getChat()->getId();

        if (isset($contact->contact)) {
            $contact = $contact->getContact();
            $phone_number = $contact->getPhoneNumber();
            $user = User::where('phone_number', $phone_number)->exists();
            $userModel = User::where('phone_number', $phone_number)->first();
            $logistcianRole = Role::where('name', RoleEnum::LOGISTICIAN->value)->first();

            if ($user && $userModel->hasRole($logistcianRole)) {
                if ((TgUser::where('phone_number', $phone_number)->exists())) {
                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Вы уже зарегистрированы в AgroLogistic, вам будут приходить уведомления об откликах на заявки созданные вами',
                    ]);

                    return 1;
                }
                if (!TgUser::where('phone_number', $phone_number)->exists()) {
                    TgUser::create(
                        [
                            'phone_number' => $phone_number,
                            'username' => $username,
                            'user_id' => $userModel->id,
                            'chat_id' => $chatId,
                        ]
                    );
                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Спасибо, вам будут приходить уведомления об откликах на заявки созданные вами',
                    ]);

                    return 1;
                }
            } else {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Вы не зарегистрированы в AgroLogistic или не являетесь логистом AgroLogistic',
                ]);

                return 1;
            }
        }
        if ($contact->text != '/start') {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'Бот реагирует только на отправку номера телефона',
                'reply_markup' => $reply_markup,
            ]);

            return 1;
        }

        return 1;

    }
}
