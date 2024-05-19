<?php

namespace App\Services;

use App\Enums\CropOrderEnum;
use App\Enums\LoadMethodEnum;
use App\Enums\OrderClarificationDayEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\OrderTimeslotEnum;
use App\Enums\StatusEnum;
use App\Filters\OrderFilter;
use App\Http\Requests\Order\OrderCitiesRequest;
use App\Http\Requests\Order\OrderCreateRequest;
use App\Http\Requests\Order\OrderFilterRequest;
use App\Http\Requests\Order\OrderUpdateRequest;
use App\Http\Resources\LoadType\LoadTypeCollection;
use App\Http\Resources\Order\OrderCreateResource;
use App\Http\Resources\Order\OrderIndexCollection;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\UnloadMethodCollection;
use App\Http\Responses\ApiJsonResponse;
use App\Models\LoadType;
use App\Models\Offer;
use App\Models\Order;
use App\Models\TgUser;
use App\Models\UnloadMethod;
use App\Models\User;
use App\Services\Dadata\Dadata;
use Illuminate\Http\Request;

class OrderService
{
    private Dadata $dadata;

    public function __construct()
    {
        $this->dadata = new Dadata;
    }

    public function index(OrderFilterRequest $request): OrderIndexCollection
    {
        $data = $request->validated();
        $filter = app()->make(OrderFilter::class, ['queryParams' => $data]);
        $order = Order::filter($filter);
        if($request->user()->orders != null){
            $userOrders = $request->user()->orders;
            if (is_null($request->sort)) {
                $order->orderBy('order_number', 'desc');
            }
            $orderCollection = $order->get()->reject(function ($item) use ($userOrders) {
                return $userOrders->contains($item);
            });
            return new OrderIndexCollection($orderCollection);

        }

        if (is_null($request->sort)) {
            $order->orderBy('order_number', 'desc');
        }

        return new OrderIndexCollection($order->get());
    }

    public function show(Order $order): OrderResource
    {
        $order->view_counter++;
        $order->save();
        return new OrderResource($order);
    }

    public function create(OrderCreateRequest $request): OrderCreateResource|array
    {
        $loadDadataCoords = $this->dadata->sendFullAddress($request->load_place_name);
        $unloadDadataCoords = $this->dadata->sendFullAddress($request->unload_place_name);
        $dadataLoadPlaceInfo = $this->dadata->getAddressArray([$request->load_place_name]);
        $dadataUnloadPlaceInfo = $this->dadata->getAddressArray([$request->unload_place_name]);
        $load_city = $dadataLoadPlaceInfo['city'] != null ? $dadataLoadPlaceInfo['city'] : $request->load_place_name;
        $load_region = $dadataLoadPlaceInfo['region'] . " " . $dadataLoadPlaceInfo['region_type_full'] != null ? $dadataLoadPlaceInfo['region'] . " " . $dadataLoadPlaceInfo['region_type_full'] : $request->load_place_name;
        $unload_city = $dadataUnloadPlaceInfo['city'] != null ? $dadataUnloadPlaceInfo['city'] : $request->unload_place_name;
        $unload_region = $dadataUnloadPlaceInfo['region'] . " " . $dadataUnloadPlaceInfo['region_type_full'] != null ? $dadataUnloadPlaceInfo['region'] . " " . $dadataUnloadPlaceInfo['region_type_full'] : $request->unload_place_name;
        $load_longitude = $loadDadataCoords[0]['lon'];
        $load_latitude = $loadDadataCoords[0]['lat'];
        $unload_latitude = $unloadDadataCoords[0]['lat'];
        $unload_longitude = $unloadDadataCoords[0]['lon'];
        $data = [
            'load_city' => $load_city,
            'load_region' => $load_region,
            'unload_city' => $unload_city,
            'unload_region' => $unload_region,
            'load_longitude' => $load_longitude,
            'unload_longitude' => $unload_longitude,
            'load_latitude' => $load_latitude,
            'unload_latitude' => $unload_latitude,
            'load_latitude'    => $load_latitude,
            'unload_latitude'  => $unload_latitude,
            'creator_id'       => $request->user()->id,
            'status' => OrderStatusEnum::ACTIVE->value,
        ];
        $queryData = array_merge($request->except(['load_types', 'unload_methods']), $data);

        $order = Order::create($queryData);

        foreach ($request->load_types as $load_type) {
            $order->loadTypes()->attach($load_type);
        }

        if (!empty($request->unload_methods)) {
            foreach ($request->unload_methods as $unload_method) {
                $order->unloadMethods()->attach($unload_method);
            }
        }

        return new OrderCreateResource($order);
    }

    public function update(OrderUpdateRequest $request, Order $order): OrderResource
    {
        $order->update($request->except(['load_types']));
        foreach ($request->load_types as $load_type) {
            $order->loadTypes()->sync($load_type);
        }
        if (!is_null($request->unload_methods)) {
            foreach ($request->unload_methods as $unload_method) {
                $order->unloadMethods()->sync($unload_method);
            }
        }
        return new OrderResource($order);
    }

    public function delete(Order $order): void
    {
        $order->delete();
    }

    public function getOptions(): array
    {
        return [
            'load_types' => new LoadTypeCollection(LoadType::all()),
            'unload_methods' => new UnloadMethodCollection(UnloadMethod::all()),
            'load_methods' => LoadMethodEnum::getLoadMethods(),
            'timeslot' => OrderTimeslotEnum::getTimselot(),
            'crop' => CropOrderEnum::getCrop(),
            'status' => OrderStatusEnum::getOrderStatus(),
            'clarification_day' => OrderClarificationDayEnum::getValue(),
        ];
    }

    public function getRegions()
    {
        $load_regions = Order::whereNotNull('load_region')->get()->pluck('load_region')->toArray();
        $unload_regions = Order::whereNotNull('unload_region')->get()->pluck('unload_region')->toArray();

        $load_regions = array_unique($load_regions);
        $unload_regions = array_unique($unload_regions);

        $data = [
            'load_regions' => $load_regions,
            'unload_regions' => $unload_regions
        ];

        return $data;
    }

    public function getCities(OrderCitiesRequest $request)
    {
        if ($request->mode == 'load') {
            $cities = Order::where('load_region', $request->load_region)->get()->pluck('load_city')->toArray();
            $cities = array_unique($cities);
            return $cities;
        }

        $cities = Order::where('unload_region', $request->unload_region)->get()->pluck('unload_city')->toArray();
        $cities = array_unique($cities);
        return $cities;
    }

    public function getOrdersWithUserOffers(Request $request)
    {
        $user = $request->user();
        return new OrderIndexCollection($user->orders);
    }


}
