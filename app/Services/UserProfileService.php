<?php

namespace App\Services;

use App\Enums\TaxSystemEnum;
use App\Http\Requests\UserProfile\AvatarRequest;
use App\Http\Requests\UserProfile\UserPasswordUpdateRequest;
use App\Http\Requests\UserProfile\UserProfileCreateRequest;
use App\Http\Requests\UserProfile\UserProfileUpdateRequest;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\User\UserResource;
use App\Models\File;
use App\Models\FileType;
use App\Models\UserFile;
use App\Models\UserProfile;
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
        $avatarType = FileType::where('title', 'Аватар')->first();
        $avatar = $this->loadFile($request->file('avatar'));
        $request->user()->files()->attach($avatar, ['file_type_id' => $avatarType->id, 'id' => uuid_create()]);
        return new FileResource($avatar);
    }

    public function updateAvatar(AvatarRequest $request): FileResource
    {
        $avatarType = FileType::where('title', 'Аватар')->first();

        $user = $request->user();

        $file = File::whereHas('userFiles', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereHas('fileType', function ($query) {
            $query->where('title', 'Аватар');
        })->with(['userFiles', 'fileType'])->first();

        $avatar = $this->updateFile($request->file('avatar'), $file);

        $user->files()->attach($avatar, ['file_type_id' => $avatarType->id, 'id' => uuid_create()]);
        return new FileResource($avatar);
    }

    public function update(UserProfileUpdateRequest $request): UserResource
    {
        $user = $request->user();
        if ($request->has('issue_date_at')) {
            $issue_date_at = Carbon::parse($request->issue_date_at);
            $user->update(
                array_merge($request->except('issue_date_at'), ['issue_date_at' => $issue_date_at])
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
