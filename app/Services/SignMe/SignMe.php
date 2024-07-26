<?php

namespace App\Services\SignMe;

use App\Enums\SignMeApiEnum;

class SignMe
{

    private SignMeClient $signMeClient;
    private string $token;
    public function __construct(
    )
    {
        $this->signMeClient = new SignMeClient();
        $this->token = config('app.sign_me_token');
    }

    public function prechek(string $inn):bool|null
    {
        $query = array(
            'inn' => $inn,
            'api_key' => $this->token,
        );
        $result = $this->signMeClient->client->post(config('app.sign_me_base_dev_url') . SignMeApiEnum::PRECHEK->value , $query);
        if($result->body() == "{}"){
            return null;
        }
        return $result['inn']['approved'];
    }

    public function register(array $data):string|int
    {
        $query = $data + ['api_key' => $this->token];
        $result = $this->signMeClient->client->post(config('app.sign_me_base_dev_url') . SignMeApiEnum::REGISTER->value, $query);
        if($result->json() == null){
            return $result->body();
        }
        return $result['id'];
    }

    public function signature(array $data):string
    {
        $query = $data + ['api_key' => $this->token];
        $result = $this->signMeClient->client->post(config('app.sign_me_base_dev_url') . SignMeApiEnum::SIGNATURE->value, $query);
        if(strpos("error",$result->body())){
            return $result->body();
        }
            return $result->body();
    }

    public function signatureCheck()
    {

    }
}
