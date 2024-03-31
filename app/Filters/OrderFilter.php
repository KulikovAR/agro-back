<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderFilter extends AbstractFilter
{
    public const CROP = 'crop';
    public const VOLUME = 'volume';
    public const DISTANCE_FROM = 'distance_from';
    public const DISTANCE_TO = 'distance_to';
    public const TARIFF = 'tariff';
    public const NDS_PERCENT = 'nds_percent';
    public const TERMINAL_NAME = 'terminal_name';
    public const TERMINAL_ADDRESS = 'terminal_address';
    public const TERMINAL_INN = 'terminal_inn';
    public const EXPORTER_NAME = 'exporter_name';
    public const EXPORTER_INN = 'exporter_inn';
    public const IS_SEMI_TRUCK = 'is_semi_truck';
    public const IS_TONAR = 'is_tonar';
    public const SCALE_LENGHT = 'scale_lenght';
    public const HEIGHT_LIMIT = 'height_limit';
    public const IS_OVERLOAD = 'is_overload';
    public const TIMESLOT = 'timeslot';
    public const OUTAGE_BEGIN = 'outage_begin';
    public const OUTAGE_PRICE = 'outage_price';
    public const DAILY_LOAD_RATE = 'daily_load_rate';
    public const CONTACT_NAME = 'contact_name';
    public const CONTACT_PHONE = 'contact_phone';
    public const CARGO_SHORTAGE_RATE = 'cargo_shortage_rate';
    public const UNIT_OF_MEASUREMENT_FOR_CARGO_SHORTAGE_RATE = 'unit_of_measurement_for_cargo_shortage_rate';
    public const CARGO_PRICE = 'cargo_price';
    public const LOAD_PLACE = 'load_place';
    public const APPROACH = 'approach';
    public const WORK_TIME = 'work_time';
    public const IS_LOAD_IN_WEEKEND = 'is_load_in_weekend';
    public const CLARIFICATION_OF_THE_WEEKEND = 'clarification_of_the_weekend';
    public const LOADER_POWER = 'loader_power';
    public const LOAD_METHOD = 'load_method';
    public const TOLERANCE_TO_THE_NORM = 'tolerance_to_the_norm';
    public const START_ORDER_AT = 'start_order_at';
    public const END_ORDER_AT = 'end_order_at';
    public const LOAD_LATITUDE = 'load_latitude';
    public const LOAD_LONGITUDE = 'load_longitude';
    public const UNLOAD_LATITUDE = 'unload_latitude';
    public const UNLOAD_LONGITUDE = 'unload_longitude';
    public const LOAD_PLACE_NAME = 'load_place_name';
    public const UNLOAD_PLACE_NAME = 'unload_place_name';
    public const CARGO_WEIGHT = 'cargo_weight';
    public const DESCRIPTION = 'description';
    public const LOAD_TYPES = 'load_types';
    public const TARIFF_ORDER = 'tariff_order';
    public const DISTANCE_ORDER = 'distance_order';

    protected function getCallbacks(): array
    {
        return [
            self::CROP                                        => [$this, 'crop'],
            self::VOLUME                                      => [$this, 'volume'],
            self::DISTANCE_FROM                               => [$this, 'distance_from'],
            self::DISTANCE_TO                                 => [$this, 'distance_to'],
            self::TARIFF                                      => [$this, 'tariff'],
            self::NDS_PERCENT                                 => [$this, 'nds_percent'],
            self::TERMINAL_NAME                               => [$this, 'terminal_name'],
            self::TERMINAL_ADDRESS                            => [$this, 'terminal_address'],
            self::TERMINAL_INN                                => [$this, 'terminal_inn'],
            self::EXPORTER_NAME                               => [$this, 'exporter_name'],
            self::EXPORTER_INN                                => [$this, 'exporter_inn'],
            self::IS_SEMI_TRUCK                               => [$this, 'is_semi_truck'],
            self::IS_TONAR                                    => [$this, 'is_tonar'],
            self::SCALE_LENGHT                                => [$this, 'scale_lenght'],
            self::HEIGHT_LIMIT                                => [$this, 'height_limit'],
            self::IS_OVERLOAD                                 => [$this, 'is_overload'],
            self::TIMESLOT                                    => [$this, 'timeslot'],
            self::OUTAGE_BEGIN                                => [$this, 'outage_begin'],
            self::OUTAGE_PRICE                                => [$this, 'outage_price'],
            self::DAILY_LOAD_RATE                             => [$this, 'daily_load_rate'],
            self::CONTACT_NAME                                => [$this, 'contact_name'],
            self::CONTACT_PHONE                               => [$this, 'contact_phone'],
            self::CARGO_SHORTAGE_RATE                         => [$this, 'cargo_shortage_rate'],
            self::UNIT_OF_MEASUREMENT_FOR_CARGO_SHORTAGE_RATE => [$this, 'unit_of_measurement_for_cargo_shortage_rate'],
            self::CARGO_PRICE                                 => [$this, 'cargo_price'],
            self::LOAD_PLACE                                  => [$this, 'load_place'],
            self::APPROACH                                    => [$this, 'approach'],
            self::WORK_TIME                                   => [$this, 'work_time'],
            self::IS_LOAD_IN_WEEKEND                          => [$this, 'is_load_in_weekend'],
            self::CLARIFICATION_OF_THE_WEEKEND                => [$this, 'clarification_of_the_weekend'],
            self::LOADER_POWER                                => [$this, 'loader_power'],
            self::LOAD_METHOD                                 => [$this, 'load_method'],
            self::TOLERANCE_TO_THE_NORM                       => [$this, 'tolerance_to_the_norm'],
            self::START_ORDER_AT                              => [$this, 'start_order_at'],
            self::END_ORDER_AT                                => [$this, 'end_order_at'],
            self::LOAD_LATITUDE                               => [$this, 'load_latitude'],
            self::LOAD_LONGITUDE                              => [$this, 'load_longitude'],
            self::UNLOAD_LATITUDE                             => [$this, 'unload_latitude'],
            self::UNLOAD_LONGITUDE                            => [$this, 'unload_longitude'],
            self::LOAD_PLACE_NAME                             => [$this, 'load_place_name'],
            self::UNLOAD_PLACE_NAME                           => [$this, 'unload_place_name'],
            self::CARGO_WEIGHT                                => [$this, 'cargo_weight'],
            self::DESCRIPTION                                 => [$this, 'description'],
            self::LOAD_TYPES                                  => [$this, 'load_types'],
            self::TARIFF_ORDER                                => [$this,'tariff_order'],
            self::DISTANCE_ORDER                              => [$this,'distance_order']
        ];
    }

    public function crop(Builder $builder, $value)
    {
        $builder->where('crop', $value);
    }

    public function volume(Builder $builder, $value)
    {
        $builder->where('volume', $value);
    }

    public function distance_to(Builder $builder, $value)
    {
        $builder->where('distance', '<=', $value);
    }

    public function distance_from(Builder $builder, $value)
    {
        $builder->where('distance', '>=', $value);
    }

    public function tariff(Builder $builder, $value)
    {
        $builder->where('tariff', $value);
    }

    public function nds_percent(Builder $builder, $value)
    {
        $builder->where('nds_percent', $value);
    }

    public function terminal_name(Builder $builder, $value)
    {
        $builder->where('terminal_name', $value);
    }

    public function terminal_address(Builder $builder, $value)
    {
        $builder->where('terminal_address', $value);
    }

    public function terminal_inn(Builder $builder, $value)
    {
        $builder->where('terminal_inn', $value);
    }

    public function exporter_name(Builder $builder, $value)
    {
        $builder->where('exporter_name', $value);
    }

    public function exporter_inn(Builder $builder, $value)
    {
        $builder->where('exporter_inn', $value);
    }

    public function is_semi_truck(Builder $builder, $value)
    {
        $builder->where('is_semi_truck', $value);
    }

    public function is_tonar(Builder $builder, $value)
    {
        $builder->where('is_tonar', $value);
    }

    public function scale_lenght(Builder $builder, $value)
    {
        $builder->where('scale_lenght', $value);
    }

    public function height_limit(Builder $builder, $value)
    {
        $builder->where('height_limit', $value);
    }

    public function is_overload(Builder $builder, $value)
    {
        $builder->where('is_overload', $value);
    }

    public function timeslot(Builder $builder, $value)
    {
        $builder->where('timeslot', $value);
    }

    public function outage_begin(Builder $builder, $value)
    {
        $builder->where('outage_begin', $value);
    }

    public function outage_price(Builder $builder, $value)
    {
        $builder->where('outage_price', $value);
    }

    public function daily_load_rate(Builder $builder, $value)
    {
        $builder->where('daily_load_rate', $value);
    }

    public function contact_name(Builder $builder, $value)
    {
        $builder->where('contact_name', $value);
    }

    public function contact_phone(Builder $builder, $value)
    {
        $builder->where('contact_phone', $value);
    }

    public function cargo_shortage_rate(Builder $builder, $value)
    {
        $builder->where('cargo_shortage_rate', $value);
    }

    public function unit_of_measurement_for_cargo_shortage_rate(Builder $builder, $value)
    {
        $builder->where('unit_of_measurement_for_cargo_shortage_rate', $value);
    }

    public function cargo_price(Builder $builder, $value)
    {
        $builder->where('cargo_price', $value);
    }

    public function load_place(Builder $builder, $value)
    {
        $builder->where('load_place', $value);
    }

    public function approach(Builder $builder, $value)
    {
        $builder->where('approach', $value);
    }

    public function work_time(Builder $builder, $value)
    {
        $builder->where('work_time', $value);
    }

    public function is_load_in_weekend(Builder $builder, $value)
    {
        $builder->where('is_load_in_weekend', $value);
    }

    public function clarification_of_the_weekend(Builder $builder, $value)
    {
        $builder->where('clarification_of_the_weekend', $value);
    }

    public function loader_power(Builder $builder, $value)
    {
        $builder->where('loader_power', $value);
    }

    public function load_method(Builder $builder, $value)
    {
        $builder->where('load_method', $value);
    }

    public function tolerance_to_the_norm(Builder $builder, $value)
    {
        $builder->where('tolerance_to_the_norm', $value);
    }

    public function start_order_at(Builder $builder, $value)
    {
        $builder->where('start_order_at', $value);
    }

    public function end_order_at(Builder $builder, $value)
    {
        $builder->where('end_order_at', $value);
    }

    public function load_latitude(Builder $builder, $value)
    {
        $builder->where('load_latitude', $value);
    }

    public function load_longitude(Builder $builder, $value)
    {
        $builder->where('load_longitude', $value);
    }

    public function unload_latitude(Builder $builder, $value)
    {
        $builder->where('unload_latitude', $value);
    }

    public function unload_longitude(Builder $builder, $value)
    {
        $builder->where('unload_longitude', $value);
    }

    public function load_place_name(Builder $builder, $value)
    {
        $builder->where('load_place_name', $value);
    }

    public function unload_place_name(Builder $builder, $value)
    {
        $builder->where('unload_place_name', $value);
    }

    public function cargo_weight(Builder $builder, $value)
    {
        $builder->where('cargo_weight', $value);
    }

    public function description(Builder $builder, $value)
    {
        $builder->where('description', $value);
    }

    public function load_types(Builder $builder, $value)
    {
        $builder->WhereHas('loadTypes', function ($q) use ($value) {
            $q->whereIn('load_type_id', $value);
        });
    }

    public function tariff_order (Builder $builder, $value)
    {
        $builder->orderBy('tariff', $value);
    }

    public function distance_order (Builder $builder, $value)
    {
        $builder->orderBy('distance', $value);
    }
}
