<?php

namespace App\Services;

use App\Enums\ModerationStatusEnum;
use App\Enums\RoleEnum;
use App\Http\Requests\Counteragent\UpdateRequest;
use App\Http\Requests\Counteragent\CreateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class CounteragentService
{
    public function create(CreateRequest $request):UserResource
    {
        Gate::authorize('create-counteragent', User::class);
        $issue_date_at = Carbon::parse($request->issue_date_at);
        $user = User::create(['creator_id'=>$request->user()->id,'moderation_status' => ModerationStatusEnum::APPROVED->value, 'issue_date_at' => $issue_date_at] + $request->except(['issue_date_at']));
        $user->assignRole(RoleEnum::CLIENT->value);
        return new UserResource($user);
    }

    public function update(UpdateRequest $request, User $user): UserResource
    {
        Gate::authorize('update-counteragent', $user);
        $authUser = $request->user();
        if($request->has('issue_date_at')){
            $issue_date_at = Carbon::parse($request->issue_date_at);
        }
        if($authUser->hasRole(RoleEnum::CLIENT->value)) {
            $user->update(['moderation_status' => ModerationStatusEnum::PENDING->value] + $request->all());
            return new UserResource($user);
        }
        $user->update($request->all());
        return new UserResource($user);


    }
}
