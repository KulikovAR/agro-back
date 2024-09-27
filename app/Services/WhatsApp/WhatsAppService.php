<?php

namespace App\Services\WhatsApp;

use App\Enums\RoleEnum;
use App\Models\User;

class WhatsAppService
{
    const INCOMING_MESSAGE_TYPE = 'incoming_message';

    private $client;

    public function __construct()
    {
        $this->client = new WhatsAppClient();
    }

    public function handler(array $data): void
    {
        if (! isset($data['messages'])) {
            return;
        }

        if (! isset($data['messages'][0]['wh_type']) || $data['messages'][0]['wh_type'] != self::INCOMING_MESSAGE_TYPE) {
            return;
        }

        $phoneNumber = $this->formatPhone($data['messages'][0]['from']);

        $user = User::where('phone_number', '+'.$phoneNumber)->first();

        if (is_null($user) || ! $user->hasRole(RoleEnum::LOGISTICIAN->value)) {
            $this->client->sendMessage('Вы не зарегистрированы в AgroLogistic или не являетесь логистом AgroLogistic', $phoneNumber);

            return;
        }

        if ($user->whats_app_verify) {
            $this->client->sendMessage('Спасибо, вы уже зарегистированы в системе. Вам будут приходить уведомления об откликах на заявки созданные вами', $phoneNumber);

            return;
        }

        $user->update([
            'whats_app_verify' => true,
        ]);

        $this->client->sendMessage('Спасибо, вам будут приходить уведомления об откликах на заявки созданные вами', $phoneNumber);

    }

    public function notifyUser(User $user, string $message): void
    {
        $phoneNumber = trim($user->phone_number, '+');
        $this->client->sendMessage($message, $phoneNumber);
    }

    protected function formatPhone(string $phoneNumber)
    {
        $phoneNumber = trim($phoneNumber, '@c.us');

        return $phoneNumber;
    }
}
