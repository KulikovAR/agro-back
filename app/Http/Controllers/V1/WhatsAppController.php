<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhatsAppController extends Controller
{
    public function webhook(Request $request)
    {
        Storage::put('whatsapp.json', json_encode($request->all()));

        return response();
    }
}
