<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Manager\ManagerCollection;
use App\Http\Responses\ApiJsonResponse;
use App\Models\User;

class ManagerContoller extends Controller
{
    public function list()
    {
        return new ApiJsonResponse(data: new ManagerCollection(User::with([
            'roles' => function ($q) {
                $q->where('name', 'manager');
            },
        ])->get()));
    }
}
