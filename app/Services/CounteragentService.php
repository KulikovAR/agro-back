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
        return User::with('counteragent')->get(); 
    }

    public function create(CreateCounteragentRequest $request):User
    {
        $counteragent = Counteragent::create($request->all());
        return User::with('counteragent')->where('id', $counteragent->user_id)->first();
    }

    public function show(User $user):User
    {   
    
        return $user::with('counteragent')->where('id', $user->id)->first();
    }

    public function update(UpdateCounteragentRequest $request, User $user):Counteragent
    {   
        $counteragent = $user->counteragent;
        $counteragent->update($request->all());
        return $user::with('counteragent')->where('id',$counteragent->user_id)->first();
    }

    public function delete(User $user):string
    {
        $counteragent = $user->counteragent;
        $counteragent->delete();
        return response()->json(['message'=>'Контрагент удалён']);
    }
}
