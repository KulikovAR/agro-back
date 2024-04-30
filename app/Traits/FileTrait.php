<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    public function loadFiles(array $uploadedFiles): array|null
    {
        $files = [];
        foreach ($uploadedFiles as $file) {
            $files[] = $this->loadFile($file);
        }
        return $files;
    }

    public function loadFile(UploadedFile $file): File
    {
        $ext = $file->extension();
        $path = Storage::disk('public')->put('/files', $file);
        return File::create(['path' => $path]);
    }

    public function deleteFile(File $file): null|bool
    {
        $fileInStorage = Storage::disk('public')->delete($file->path);
        if (!$fileInStorage) {
            return null;
        }
        return $file->delete();
    }

    public function updateFile(UploadedFile $uploadedFile, File $file = null): File
    {
        $this->deleteFile($file);
        return $this->loadFile($uploadedFile);
    }

    public function deleteFiles(array $files): void
    {
        foreach ($files as $file) {
            $this->deleteFile($file);
        }
    }


    public function updateFiles(array $uploadedFiles, array $files): array
    {
        $this->deleteFiles($files);
        return $this->loadFiles($uploadedFiles);
    }
}
