<?php

namespace App\Services;

use App\Http\Requests\Transport\CreateTransportRequest;
use App\Http\Requests\Transport\UpdateTransportRequest;
use App\Http\Requests\UuidRequest;
use App\Models\Transport;
use Illuminate\Database\Eloquent\Collection;

class TransportService
{
    public function index(): Collection
    {
        return Transport::with('driver', 'user')->get();
    }

    public function create(CreateTransportRequest $request): Transport
    {
        return Transport::create([
            'driver_id' => $request->driver_id,
            'type' => $request->type,
            'number' => $request->number,
            'model' => $request->model,
            'description' => $request->description,
            'free' => $request->free,
            'is_active' => $request->is_active,
            'capacity' => $request->capacity,
            'volume_cm' => $request->volume_cm,
        ]);
    }

    public function show(UuidRequest $request): Transport
    {
        return Transport::findOrFail($request->id);
    }

    public function update(UpdateTransportRequest $request, Transport $transport): Transport
    {
        $transport->update([
            $request->all(),
        ]);

        return $transport;
    }

    public function delete(Transport $transport): string
    {
        $transport->delete();

        return 'Транспорт удалён';
    }
}
