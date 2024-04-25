<?php

namespace App\Services;

use App\Http\Requests\Offer\OfferRequest;
use App\Http\Resources\Offer\OfferResource;
use App\Models\Offer;

class OfferService
{
    public function create(OfferRequest $request)
    {
        $user = $request->user();
        $offer = Offer::firstOrCreate(['user_id' => $user->id, 'order_id' => $request->order_id],['user_id' => $user->id, 'order_id' => $request->order_id]);
        return new OfferResource($offer);
    }
}
