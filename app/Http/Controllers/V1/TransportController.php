<?php

namespace App\Http\Controllers\V1;
use App\Http\Controllers\Controller;
use App\Enums\StatusEnum;
use App\Http\Requests\Transport\CreateTransportRequest;
use App\Http\Requests\Transport\UpdateTransportRequest;
use App\Http\Requests\UuidRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Services\TransportService;
use Illuminate\Http\Request;
use App\Http\Resources\Transport\TransportCollection;
use App\Http\Resources\Transport\TransportResource;
use App\Models\Transport;

class TransportController extends Controller
{

    public function __construct(
        private TransportService $service
    ) {
        $this->service = new TransportService;
    }
    public function index(): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            data: [
                new TransportCollection($this->service->index()),
            ]
        );
    }

    public function create(CreateTransportRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            data: [
                new TransportResource($this->service->create($request)),
            ]
        );
    }


    public function show(UuidRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            data: [
                new TransportResource($this->service->show($request)),
            ]
        );
    }


    public function update(UpdateTransportRequest $request, Transport $transport): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            data: [
                new TransportResource($this->service->update($request, $transport)),
            ]
        );
    }

    
    public function delete(Transport $transport): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            __($this->service->delete($transport)),
            data: [
                
            ]
        );
    }
}
