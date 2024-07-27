<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Counteragent\CreateRequest;
use App\Http\Requests\Counteragent\UpdateRequest;
use App\Http\Resources\Counteragent\CounteragentCollection;
use App\Http\Resources\Counteragent\CounteragentResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Http\Responses\ApiJsonResponse;
use App\Models\UserProfile;
use App\Models\User;
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
        return new ApiJsonResponse(200, StatusEnum::OK, 'Все контрагенты получены', data: new UserCollection($this->service->index()));
    }

    public function show(User $user): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Контрагент получен', data: new UserResource($this->service->show($user)));
    }

    public function create(CreateRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Контрагент создан', data: new UserResource($this->service->create($request)));
    }

    public function update(UpdateRequest $request, User $user): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Контрагент обновлён', data: new UserResource($this->service->update($request, $user)));
    }

    public function delete(User $user): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, $this->service->delete($user), data: []);
    }
}
