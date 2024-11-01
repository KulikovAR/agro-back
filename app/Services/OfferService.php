<?php

namespace App\Services;

use App\Http\Requests\Offer\OfferRequest;
use App\Http\Resources\Offer\OfferResource;
use App\Models\Offer;
use App\Notifications\OrderNotification;
use App\Services\WhatsApp\WhatsAppService;

class OfferService
{
    private $whatsAppService;

    public function __construct()
    {
        $this->whatsAppService = new WhatsAppService;
    }

    public function create(OfferRequest $request)
    {
        $user = $request->user();
        $offer = Offer::firstOrCreate(['user_id' => $user->id, 'order_id' => $request->order_id], ['user_id' => $user->id, 'order_id' => $request->order_id]);
        $logistician = $offer->order->creator;
        //        $logistician->notify(new OrderNotification($this->textToBot($offer)));

        $textToBot = $this->textToBot($offer);
        TgService::notifyUser($logistician, $textToBot);
        $this->whatsAppService->notifyUser($logistician, $textToBot);

        return new OfferResource($offer);
    }

    public function textToBot(Offer $offer)
    {
        $order = $offer->order;
        $text = $order->load_place_name.' --> '.$order->unload_place_name."\n";
        $text .= $order->crop.' '.$order->volume."\n";
        $text .= $order->distance.' '.'км'.' '.'='.' '.$order->tariff.' '.'руб/тн'."\n";
        foreach ($order->unloadMethods as $unloadMethod) {
            if (! next($order->unloadMethods)) {
                $text .= $unloadMethod->title.','.' ';
            } else {
                $text .= $unloadMethod->title.',';
            }
        }
        $text .= $order->scale_length.' '.'м'.',';
        foreach ($order->loadTypes as $loadType) {
            if (! next($order->loadTypes)) {
                $text .= $loadType->title."\n";
            } else {
                $text .= $unloadMethod->title.',';
            }
        }
        $text .= $offer->user->phone_number;

        return $text;
    }
}
