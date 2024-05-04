<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfile\AvatarRequest;
use App\Http\Requests\UserProfile\UserProfileCreateRequest;
use App\Http\Requests\UserProfile\UserProfileUpdateRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Models\File;
use App\Services\UserProfileService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function __construct(
        private UserProfileService $service
    ) {
        $this->service = new UserProfileService();
    }

    public function getUserProfileByToken(Request $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Информация о пользователе получена',
            data: $this->service->getUserProfileByToken($request)
        );
    }

    public function loadAvatar(AvatarRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Аватар пользователя загружен',
            data: $this->service->loadAvatar($request)
        );
    }

    public function updateAvatar(AvatarRequest $request, File $file): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Аватар пользователя обновлён',
            data: $this->service->updateAvatar($request, $file)
        );
    }
    public function create(UserProfileCreateRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200, StatusEnum::OK, 'Профиль создан', data: $this->service->create($request)
        );
    }

    public function update(UserProfileUpdateRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,StatusEnum::OK,'Профиль обновлён', data: $this->service->update($request)
        );
    }
}
