<?php

namespace App\Services;

use App\Enums\FileTypeEnum;
use App\Http\Requests\File\CreateFileRequest;
use App\Http\Requests\File\CreateUserFileRequest;
use App\Http\Requests\File\DeleteUserFileRequest;
use App\Http\Requests\File\FileFilterRequest;
use App\Http\Requests\File\FromIcRequest;
use App\Http\Requests\File\UpdateUserFileRequest;
use App\Http\Resources\File\FileCollection;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\File\GetDataFrom1CResource;
use App\Models\File;
use App\Models\User;
use App\Repositories\IcRepository;
use App\Services\SignMe\SignMe;
use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FileService
{
    use FileTrait;

    private IcRepository $IcRepository;
    private SignMe $signMe;
    public function __construct(

    ) {
        $this->IcRepository = new IcRepository();
        $this->signMe       = new SignMe();
    }

    public function index(): FileCollection
    {
        return new FileCollection(File::all());
    }

    public function show(File $file): FileResource
    {
        return new FileResource($file);
    }

    public function create(CreateFileRequest $request): FileResource
    {
        return new FileResource($this->loadFile($request->file, $request->type));
    }

    public function getDocumentsForSigning(Request $request): FileCollection
    {
        $user = $request->user();

        $files = $user->files()->where(function ($query) {
            $query->where('type', FileTypeEnum::REQUEST->value)
                ->orWhere('type', FileTypeEnum::CONTRACT->value)
                ->orWhere('type', FileTypeEnum::ACT->value);
        })->get();

        if (is_null($files)) {
            return new FileCollection([]);
        }

        $this->checkSignature($files);

        return new FileCollection($files);
    }

    private function checkSignature(Collection $files)
    {
        foreach ($files as $file) {
            // // if($file->id != '9cf1dc70-d435-4728-b7ed-88c32290e129') {
            if($file->id != '9cedead3-3d75-4a05-a28b-95582a5af9e6') {
                continue;
            }

            if ($file->is_signed) {
                continue;
            }
            $signatureCheckResult = $this->signMe->signatureCheck($file->md5_hash, $this->base64Encode($file->path));

            if (!isset($signatureCheckResult['count']) || $signatureCheckResult['count'] < 1) {
                continue;  
            }

            if (!isset($signatureCheckResult['pdf'])) {
                continue;
            }

            $file->update(['is_signed' => true]);
            
            if(is_null($file->id_1c) || !isset($signatureCheckResult['pdf'])) {
                continue;
            }
   
            $this->IcRepository->loadFileToIc($signatureCheckResult['pdf'], $file->name, $file->id_1c);
            Log::info("Подписанный файл ушёл в 1с. id:{$file->id_1c} ");
        }
        return new FileCollection($files);
    }
    public function getFileTypes(): array
    {
        return FileTypeEnum::getValues();
    }
    private function userAttachFiles(array $files, User $user)
    {
        foreach ($files as $key => $file) {
            $user->files()->attach($file);
        }
    }
    public function loadFileFrom1C(FromIcRequest $request, string $inn): GetDataFrom1CResource
    {
        Gate::authorize('loadFileFrom1C', File::class);
        $user       = User::where('inn', $inn)->first();
        $fileFromIc = $this->IcRepository->IcFile($request->file, $request->type, $request->id_1c);
        $user->files()->attach($fileFromIc);
        return new GetDataFrom1CResource($fileFromIc);
    }
    public function loadFilesForUser(CreateUserFileRequest $request)
    {
        //        dd($request);
        $user  = $request->user();
        $files = $this->loadFiles($request->documents);
        $this->userAttachFiles($files, $user);
        return new FileCollection($files);
    }

    public function updateFilesForUser(UpdateUserFileRequest $request)
    {
        //        dd($request);
        $user  = $request->user();
        $types = [];
        foreach ($request->documents as $item) {
            $ids[] = $item['file_id'];
        }
        $files = $user->files()->whereIn('files.id', $ids)->get();
        //        dd($files);
        $uploadFiles = $this->updateFiles($request->documents, $files);
        $this->userAttachFiles($uploadFiles, $user);
        return new FileCollection($files);
    }

    public function deleteUserFiles(DeleteUserFileRequest $request): void
    {
        $user  = $request->user();
        $files = $user->files()->whereIn('files.id', $request->file_id)->get();
        $this->deleteFiles($files);
    }


    public function delete(File $file): void
    {
        $this->deleteFile($file);
    }

}
