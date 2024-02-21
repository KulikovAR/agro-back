<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Counteragent\CreateCounteAgentRequest;
use App\Http\Requests\Counteragent\UpdateCounterAgentRequest;
use App\Http\Resources\Counteragent\CounteragentCollection;
use App\Http\Resources\Counteragent\CounteragentResource;
use App\Http\Responses\ApiJsonResponse;
use App\Models\Counteragent;
use App\Services\CounteragentService;
use Illuminate\Http\Request;

class CounteragentController extends Controller
{

    public function __construct(
        private CounteragentService $service
    ) {
        $this->service = new CounteragentService;
    }
    public function index(): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Все контрагенты получены', data: new CounteragentCollection($this->service->index()));
    }

    public function show(Counteragent $counteragent): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Контрагент получен', data: new CounteragentResource($this->service->show($counteragent)));
    }

    public function create (CreateCounteAgentRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(200,StatusEnum::OK, 'Контрагент создан', data:new CounteragentResource($this->service->create($request)));
    }

    public function update (UpdateCounterAgentRequest $request, Counteragent $counteragent): ApiJsonResponse
    {
        return new ApiJsonResponse(200,StatusEnum::OK, 'Контрагент обновлён', data:new CounteragentResource($this->service->update($request, $counteragent)));
    }

    public function delete (Counteragent $counteragent): ApiJsonResponse
    {
        return new ApiJsonResponse(200,StatusEnum::OK, $this->service->delete($counteragent), data:[]);
    }
}
