<?php

namespace App\Services;

use App\Http\Requests\UserProfile\AvatarRequest;
use App\Http\Requests\UserProfile\UserPasswordUpdateRequest;
use App\Http\Requests\UserProfile\UserProfileCreateRequest;
use App\Http\Requests\UserProfile\UserProfileUpdateRequest;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\User\UserResource;
use App\Models\File;
use App\Models\UserProfile;
use App\Traits\FileTrait;
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
        $avatar = $this->loadFile($request->file('avatar'));
        $request->user()->files()->attach($avatar, ['file_type_id' => $request->file_type]);
        return new FileResource($avatar);
    }

    public function updateAvatar(
        AvatarRequest $request,
        File $file
    ): FileResource {
        $avatar = $this->updateFile($request->file('avatar'), $file);
        $request->user()->files()->attach($avatar, ['file_type_id' => $request->file_type]);
        return new FileResource($avatar);
    }

    public function update(UserProfileUpdateRequest $request): UserResource
    {
        $user = $request->user();
        $user->userProfile()->update($request->all());
        return new UserResource($user);
    }
}
