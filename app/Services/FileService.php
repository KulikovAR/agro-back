<?php

namespace App\Services;

use App\Http\Requests\File\CreateFileRequest;
use App\Http\Requests\File\CreateUserFileRequest;
use App\Http\Resources\File\FileCollection;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\FileType\FileTypeCollection;
use App\Models\File;
use App\Models\FileType;
use App\Models\User;
use App\Traits\FileTrait;

class FileService
{
    use FileTrait;

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
        return new FileResource($this->loadFile($request->file('file')));
    }

    public function update(CreateFileRequest $request, File $file): FileResource
    {
        return new FileResource($this->updateFile($request->file('file'), $file));
    }

    private function userAttachFiles(array $files, User $user, array $file_types)
    {
        foreach ($files as $key => $file) {
            $user->files()->attach(
                $file,
                ['file_type_id' => $file_types[$key]]
            );
        }
    }

    public function loadFilesForUser(CreateUserFileRequest $request)
    {
        $user = $request->user();
        $files = $this->loadFiles($request->load_files);
        $this->userAttachFiles($files, $user, $request->file_types);
        return new FileCollection($files);
    }

    public function getFileTypes()
    {
        return new FileTypeCollection(FileType::all());
    }

    public function delete(File $file): void
    {
        $this->deleteFile($file);
    }

}
