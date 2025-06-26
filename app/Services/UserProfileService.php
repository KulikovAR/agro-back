<?php

namespace App\Services;

use App\Enums\FileTypeEnum;
use App\Enums\TaxSystemEnum;
use App\Http\Requests\UserProfile\AvatarRequest;
use App\Http\Requests\UserProfile\UserProfileUpdateRequest;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\User\UserResource;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserProfileService
{
    use FileTrait;

    public function getUserProfileByToken(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function loadAvatar(AvatarRequest $request): FileResource
    {
        $files = $request->user()->files()->where('type', FileTypeEnum::AVATAR->value)->get();

        foreach($files as $file) {
            $this->deleteFile($file);
        }

        $avatar = $this->loadFile($request->file('avatar'), FileTypeEnum::AVATAR->value);
        $request->user()->files()->attach($avatar);

        return new FileResource($avatar);
    }

    public function updateAvatar(AvatarRequest $request): FileResource
    {
        $user = $request->user();

        $file = $user->files()->where('type', FileTypeEnum::AVATAR->value)->first();

        $avatar = $this->updateFile($request->file('avatar'), $file, FileTypeEnum::AVATAR->value);

        $user->files()->attach($avatar);

        return new FileResource($avatar);
    }

    public function update(UserProfileUpdateRequest $request): UserResource
    {
        $user = $request->user();
        if ($request->has('issue_date_at')) {
            $issue_date_at = Carbon::parse($request->issue_date_at);
            $user->update(
                [...$request->except('issue_date_at'), 'issue_date_at' => $issue_date_at]
            );

            return new UserResource($user);
        }
        $user->userProfile()->update($request->all());

        return new UserResource($user);
    }

    public function delete(Request $request): void
    {
        $user = $request->user();
        if ($user->files) {
            $this->deleteFiles($user->files);
        }
        $user->update($user->clearProfile());
    }

    public function getTaxSystems()
    {
        return TaxSystemEnum::getValues();
    }
}
