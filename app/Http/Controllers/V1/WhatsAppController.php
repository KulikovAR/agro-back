<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\WhatsApp\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhatsAppController extends Controller
{
    public $service;
    
    public function __construct()
    {
        $this->service = new WhatsAppService();
    }
    public function webhook(Request $request)
    {
        Storage::put('whatsapp.json', json_encode($request->all()));

        $this->service->handler($request);

        return 1;
    }
}
