<?php

namespace App\Services\SignMe;

use App\Enums\SignMeApiEnum;

class SignMe
{
    private SignMeClient $signMeClient;

    private string $token;

    public function __construct(
    ) {
        $this->signMeClient = new SignMeClient();
        $this->token = config('app.sign_me_token');
    }

    public function prechek(string $inn): ?bool
    {
        $query = [
            'inn' => $inn,
            'api_key' => $this->token,
        ];
    
        $result = $this->signMeClient->client->post(config('app.sign_me_base_dev_url').SignMeApiEnum::PRECHEK->value, $query);

        if ($result->body() == '{}') {
            return null;
        }   

        return $result['inn']['approved'] && isset($result['inn']['apprtype']) && $result['inn']['apprtype'] == 1;
    }

    public function prechekRegister(string $inn): ?bool
    {
        $query = [
            'inn'     => $inn,
            'api_key' => $this->token,
        ];

        $result = $this->signMeClient->client->post(config('app.sign_me_base_dev_url') . SignMeApiEnum::PRECHEK->value, $query);
        
        if ($result->body() == '{}') {
            return null;
        }

        return isset($result['inn']);
    }

    public function prechekActivation(string $ogrn): ?bool
    {
        $query = [
            'cogrn' => $ogrn,
            'api_key' => $this->token,
        ];
        $result = $this->signMeClient->client->post(config('app.sign_me_base_dev_url').SignMeApiEnum::PRECHEK->value, $query);
        if ($result->body() == '{}') {
            return null;
        }

        return $result['cogrn']['created'];
    }

    public function register(array $data): array|string
    {

        $query = $data + ['api_key' => $this->token];

        $result = $this->signMeClient->client->post(config('app.sign_me_base_dev_url').SignMeApiEnum::REGISTER->value, $query);
        if ($result->json() == null) {
            return $result->body();
        }

        return json_decode($result->body(), true);
    }

    public function signature(array $data): string
    {
        $query = $data + ['api_key' => $this->token];
        // dd($query);
        $result = $this->signMeClient->client->post(config('app.sign_me_base_dev_url').SignMeApiEnum::SIGNATURE->value, $query);
        // dd(json_encode($result->body()));
        if (strpos('error', $result->body())) {
            return 'error';
        }

        return config('app.sign_me_base_dev_url').SignMeApiEnum::SIGNATURE->value.'/'.$result->body();
    }

    public function signatureCheck(string $md5, string $file, int $isPdf = 1): array
    {
        $query = ['md5' => $md5, 'pdf' => $isPdf, 'filet' => $file] + ['api_key' => $this->token];
        $result = $this->signMeClient->client->post(config('app.sign_me_base_dev_url').SignMeApiEnum::SIGNATURE_CHECK->value, $query);
        $data = json_decode($result->body(), true);

        return $data ?? [];
    }

    public function comactivate(int $id): string
    {
        $query = ['cid' => $id] + ['api_key' => $this->token];
        $result = $this->signMeClient->client->post(config('app.sign_me_base_dev_url').SignMeApiEnum::COMACTIVAE->value, $query);
        if ($result->body() == 0) {
            $error = 'Произошла ошибка, обратитесь в SignMe';

            return $error;
        }

        return $result->body();
    }
}
