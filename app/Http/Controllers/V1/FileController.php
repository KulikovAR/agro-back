<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\File\CreateFileRequest;
use App\Http\Requests\File\CreateUserFileRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Models\File;
use App\Services\FileService;

class FileController extends Controller
{
    public function __construct(
        private FIleService $service
    ) {
        $this->service = new FileService();
    }

    public function index(): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Документы получены', data: $this->service->index());
    }

    public function show(File $file): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Документ получен', data: $this->service->show($file));
    }

    public function create(CreateFileRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Документ загружен', data: $this->service->create($request));
    }

    public function update(CreateFileRequest $request, File $file): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200, StatusEnum::OK, 'Документ обновлён', data: $this->service->update(
            $request,
            $file
        )
        );
    }

    public function delete(File $file): ApiJsonResponse
    {
        $this->service->delete($file);
        return new ApiJsonResponse(200, StatusEnum::OK, 'Документ удалён', data: []);
    }

    public function loadFilesForUser(CreateUserFileRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            'Документы пользователя загружены',
            data: $this->service->loadFilesForUser($request)
        );
    }

    public function getFileTypes(): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200,
            StatusEnum::OK,
            message: 'Получены все типы документов',
            data: $this->service->getFileTypes()
        );
    }
}
