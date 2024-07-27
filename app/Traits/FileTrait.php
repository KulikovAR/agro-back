<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    public function loadFiles(array $documents): array|null
    {
        $files = [];
        foreach ($documents as $item) {
            $files[] = $this->loadFile($item['file'], $item['file_type']);
        }
        return $files;
    }

    public function loadFile(UploadedFile $file, string $type): File
    {
        $ext = $file->extension();
        $path = Storage::disk('public')->put('/files', $file);
        $md5 = md5_file($file);
        return File::create(['path' => $path,'type'=>$type, 'md5_hash'=>$md5]);
    }

    public function loadFileInBase64(string $file, string $type, string $IcId): File
    {
        preg_match('/^data:(.*?);base64,(.*)$/', $file, $matches);
        $mimeType = $matches[1];
        $fileContent = base64_decode($matches[2]);
        $extension = explode('/', $mimeType)[1];
        $fileName = uniqid().'.'.$extension;
        $path = '/filesBase64/' . $fileName;
        $md5 = md5($fileContent);
        $result = Storage::disk('public')->put($path, $fileContent);
        return File::create(['path' => $path,'type'=>$type, 'id_1c'=>$IcId,'md5_hash'=>$md5]);
    }
    public function deleteFile(File $file): null|bool
    {
        $fileInStorage = Storage::disk('public')->delete($file->path);
        if (!$fileInStorage) {
            return null;
        }
        return $file->delete();
    }

    public function updateFile(UploadedFile $uploadedFile, File $file, string $type): File
    {
        $this->deleteFile($file);
        return $this->loadFile($uploadedFile, $type);
    }

    public function deleteFiles(Collection $files): void
    {
        foreach ($files as $file) {
            $this->deleteFile($file);
        }
    }


    public function updateFiles(array $documents, Collection $files): array
    {
        $this->deleteFiles($files);
        return $this->loadFiles($documents);
    }
}
