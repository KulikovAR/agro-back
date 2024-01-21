<?php

namespace Tests\Unit\ProductParser;

use App\Services\ProductParser\Parser\Parser;
use App\Services\ProductParser\Parser\ParserHttp;
use Tests\TestCase;

class ParserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    { 
        $client = new ParserHttp();
        $client->wheatBodyHttp();
        $parser = new Parser($client->wheatBodyHttp(),0,10);
        $parser->callParse();
       dd( $parser->getResult());
    }
}
