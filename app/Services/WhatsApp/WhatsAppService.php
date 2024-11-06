<?php

namespace App\Services\WhatsApp;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Models\WhatsAppClient as ModelWhatsAppClient;

class WhatsAppService
{
    const INCOMING_MESSAGE_TYPE = 'incoming_message';

    private $client;
    private $client_2;

    public function __construct()
    {
        $this->client   = new WhatsAppClient(config('whatsapp.api_token'), config('whatsapp.profile_id'));
        $this->client_2 = new WhatsAppClient(config('whatsapp.api_token_2'), config('whatsapp.profile_id_2'));
    }

    public function handler(array $data): void
    {
        if (!isset($data['messages'])) {
            return;
        }

        if (isset($data['messages'][0]['chat_type']) && isset($data['messages'][0]['chat_type']) == 'group') {
            $message_data = $data['messages'][0];
            if (!isset($message_data['chatId'])) {
                return;
            }

            $chatId = $message_data['chatId'];
            $to     = str_replace('@c.us', '', $message_data['to']);

            ModelWhatsAppClient::createOrFirst([
                'chat_id' => $chatId,
            ],[
                'name'    => isset($message_data['senderName']) ? $message_data['senderName'] : null,
                'chat_id'  => $chatId,
                'type'    => $message_data['chat_type'],
                'account' => $to
            ]);
            return;
        }

        if (!isset($data['messages'][0]['wh_type']) || $data['messages'][0]['wh_type'] != self::INCOMING_MESSAGE_TYPE) {
            return;
        }

        $phoneNumber = $this->formatPhone($data['messages'][0]['from']);

        $user = User::where('phone_number', '+' . $phoneNumber)->first();

        if (is_null($user) || !$user->hasRole(RoleEnum::LOGISTICIAN->value)) {
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

    public function notifyGroups(string $message): void
    {
        $clients = ModelWhatsAppClient::all();

        foreach ($clients as $client) {
            if ($client->account == config('whatsapp.phone')) {
                $this->client->sendMessage($message, $client->chat_id);
            }
            if ($client->account == config('whatsapp.phone_2')) {
                $this->client_2->sendMessage($message, $client->chat_id);
            }
        }

        return;
    }

    protected function formatPhone(string $phoneNumber)
    {
        $phoneNumber = trim($phoneNumber, '@c.us');

        return $phoneNumber;
    }
}
