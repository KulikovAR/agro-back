<?php
namespace App\Services\ProductParser\Parser;

use Illuminate\Support\Facades\Http;

class ParserHttp
{
    private Http $client;
    public function __construct(
        
    ){
        $this->client = new Http();
    }
    
    private function bodyForParsing($api):string
    {
        $response = $this->client::get($api);
        return $response->body();
    }
    public function wheatBodyHttp()  
    {   
        return $this->bodyForParsing(config('parser.wheat_path'));
    }

    public function barleyBodyHttp()
    {
        return $this->bodyForParsing(config('parser.barley_path'));
    }
}