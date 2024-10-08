<?php

namespace App\Http\Responses;

use App\Traits\ApiJsonPaginationData;
use Illuminate\Http\JsonResponse;

class ApiJsonPaginationResponse extends ApiJsonResponse
{
    use ApiJsonPaginationData;

    public function toResponse($request): JsonResponse
    {
        return response()->json(
            array_merge(
                $this->getData(),
                $this->getPaginationData($this->data)
            ),
            $this->httpCode
        );
    }
}
