<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    public function loadFiles(array $documents): ?array
    {
        $files = [];
        foreach ($documents as $item) {
            $files[] = $this->loadFile($item['file'], $item['file_type']);
        }

        return $files;
    }

    public function loadFile(UploadedFile $file, string $type, ?string $IcId = null): File
    {
        $ext = $file->extension();
        $path = Storage::disk('public')->put('/files', $file);
        $name = $file->getClientOriginalName();
        $md5 = md5_file($file);

        return File::create(['path' => $path, 'type' => $type, 'md5_hash' => $md5, 'name' => $name, 'is_signed' => false, 'id_1c' => $IcId]);
    }

    //    public function loadFileInBase64(UploadedFile $file, string $type, string $IcId): File
    //    {
    //        $ext = $file->extension();
    //        $path = Storage::disk('public')->put('/files_from_1C', $file);
    //        $md5 = md5_file($file);
    //        return File::create(['path' => $path,'type'=>$type, 'id_1c'=>$IcId,'md5_hash'=>$md5,'is_signed'=>false]);
    //    }
    public function deleteFile(File $file): ?bool
    {
        $fileInStorage = Storage::disk('public')->delete($file->path);
        if (! $fileInStorage) {
            return null;
        }

        return $file->delete();
    }

    public function base64Encode(string $path): string
    {
        $file = Storage::disk('public')->get($path);

        return $file = base64_encode($file);
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
