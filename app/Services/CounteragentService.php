<?php

namespace App\Services;

use App\Enums\ModerationStatusEnum;
use App\Enums\RoleEnum;
use App\Http\Requests\Counteragent\CreateRequest;
use App\Http\Requests\Counteragent\UpdateRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CounteragentService
{
    public function create(CreateRequest $request): UserResource
    {
        Gate::authorize('create-counteragent', User::class);
        $issue_date_at = Carbon::parse($request->issue_date_at);
        $bdate = Carbon::parse($request->bdate);
        $user = User::create(['creator_id' => $request->user()->id, 'moderation_status' => ModerationStatusEnum::APPROVED->value, 'issue_date_at' => $issue_date_at, 'bdate' => $bdate] + $request->except(['issue_date_at', 'bdate']));
        $user->assignRole(RoleEnum::CLIENT->value);

        return new UserResource($user);
    }

    public function index(Request $request): UserCollection
    {
        Gate::authorize('index-counteragent', User::class);
        $counteragents = $request->user()->counteragents();
        $counteragents = $request->has('page') ? $counteragents->paginate(15) : $counteragents->get();

        return new UserCollection($counteragents);

    }

    public function show(Request $request, User $counteragent): UserResource
    {
        $user = $request->user();
        if (! $user->counteragents->contains($counteragent)) {
            abort(404);
        }

        return new UserResource($counteragent);
    }

    public function update(UpdateRequest $request, User $user): UserResource
    {
        Gate::authorize('update-counteragent', $user);
        $authUser = $request->user();
        $issue_date_at = Carbon::parse($request->issue_date_at);
        $bdate = Carbon::parse($request->bdate);
        $data = $request->except(['bdate', 'issue_date_at']) + ['bdate' => $bdate, 'issue_date_at' => $issue_date_at];
        if ($authUser->hasRole(RoleEnum::CLIENT->value)) {
            $user->update(['moderation_status' => ModerationStatusEnum::PENDING->value] + $data);

            return new UserResource($user);
        }
        $user->update($data);

        return new UserResource($user);

    }
}
