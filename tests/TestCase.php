<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function assertSameResource(JsonResource $resource, array $responseArray): void
    {
        $this->assertSame(json_decode($resource->toJson(), true), $responseArray);
    }
}

