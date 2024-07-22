<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\File\CreateFileRequest;
use App\Http\Requests\File\CreateUserFileRequest;
use App\Http\Requests\File\DeleteUserFileRequest;
use App\Http\Requests\File\FromIcRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Models\File;
use App\Repositories\IcRepository;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct(
        private FileService $service,
//        private IcRepository $repository,
    ) {
        $this->service = new FileService();
    }

    public function index(): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Документы получены', data: $this->service->index());
    }

    public function getDocumentsForSigning(Request $request): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, '', data: $this->service->getDocumentsForSigning($request));
    }
    public function loadFileFrom1C(FromIcRequest $request, string $inn): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, '', data: $this->service->loadFileFrom1C($request, $inn));
    }
    public function show(File $file): ApiJsonResonse
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

    public function updateFilesForUser(CreateUserFileRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(
            200, StatusEnum::OK, 'Документы обновлены', data: $this->service->updateFilesForUser($request)
        );
    }

    public function deleteUserFiles(DeleteUserFileRequest $request): ApiJsonResponse
    {
        $this->service->deleteUserFiles($request);
        return new ApiJsonResponse(
            200, StatusEnum::OK, 'Документы удалены', data: []
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
