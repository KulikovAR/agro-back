<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Events\RegisteredUserEvent;
use App\Models\Counteragent;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Counteragent\CreateCounteragentRequest;
use App\Http\Requests\Counteragent\UpdateCounteragentRequest;
use App\Models\User;

class CounteragentService


{

    public function index ():Collection
    {
        return Counteragent::all(); 
    }

    public function create(CreateCounteragentRequest $request):Counteragent
    {
        $counteragent = Counteragent::create($request->all());
        return $counteragent;
    }

    public function show(User $user):Counteragent
    {   
        $counteragent = $user->counteragent;
        return $counteragent->first();
    }

    public function update(UpdateCounteragentRequest $request, User $user):Counteragent
    {   
        $counteragent = $user->counteragent;
        $counteragent->update($request->all());
        return $counteragent;
    }

    public function delete(User $user):string
    {
        $counteragent = $user->counteragent;
        $counteragent->delete();
        return response()->json(['message'=>'Контрагент удалён']);
    }
}
