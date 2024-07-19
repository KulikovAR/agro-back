<?php

namespace App\Services;

use App\Enums\ModerationStatusEnum;
use App\Enums\RoleEnum;
use App\Http\Requests\Counteragent\UpdateRequest;
use App\Http\Requests\Counteragent\CreateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Gate;

class CounteragentService
{
    public function create(CreateRequest $request):UserResource
    {
        Gate::authorize('create-counteragent', User::class);
        $user = User::create(['creator_id'=>$request->user()->id,'moderation_status' => ModerationStatusEnum::APPROVED->value] + $request->all());
        $user->assignRole(RoleEnum::CLIENT->value);
        return new UserResource($user);
    }

    public function update(UpdateRequest $request, User $user): UserResource
    {
        Gate::authorize('update-counteragent', $user);
        $authUser = $request->user();
        if($authUser->hasRole(RoleEnum::CLIENT->value)) {
            $user->update(['moderation_status' => ModerationStatusEnum::PENDING->value] + $request->all());
            return new UserResource($user);
        }
        $user->update($request->all());
        return new UserResource($user);


    }
}
