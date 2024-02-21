<?php

namespace App\Services;

use App\Enums\StatusEnum;
use App\Events\RegisteredUserEvent;
use App\Http\Requests\Counteragent\CreateCounteAgentRequest;
use App\Models\Counteragent;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Counteragent\CreateCounterAgentRequest;
use App\Http\Requests\Counteragent\UpdateCounterAgentRequest;

class CounteragentService


{

    public function index ():Collection
    {
        return Counteragent::all(); 
    }

    public function create(CreateCounteAgentRequest $request):Counteragent
    {
        $counteragent = Counteragent::create($request->all());
        return $counteragent;
    }

    public function show(Counteragent $counteragent):Counteragent
    {
        return $counteragent->where('id',$counteragent->id)->first();
    }

    public function update(UpdateCounterAgentRequest $request, Counteragent $counteragent):Counteragent
    {
        $counteragent -> update($request->all());
        return $counteragent;
    }

    public function delete($counteragent):string
    {
        $counteragent->delete();
        return response()->json(['message'=>'Контрагент удалён']);
    }
}
