<?php

namespace App\Models;

use App\Observers\OrderObserver;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use Filterable;
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'id',
        'order_number',
        'crop',
        'volume',
        'distance',
        'tariff',
        'nds_percent',
        'terminal_name',
        'terminal_inn',
        'exporter_name',
        'exporter_inn',
        'scale_length',
        'height_limit',
        'is_overload',
        'timeslot',
        'outage_begin',
        'outage_price',
        'daily_load_rate',
        'contact_name',
        'contact_phone',
        'cargo_shortage_rate',
        'unit_of_measurement_for_cargo_shortage_rate',
        'cargo_price',
        'load_place',
        'approach',
        'work_time',
        'clarification_of_the_weekend',
        'loader_power',
        'load_method',
        'tolerance_to_the_norm',
        'start_order_at',
        'end_order_at',
        'load_latitude',
        'load_longitude',
        'unload_latitude',
        'unload_longitude',
        'load_place_name',
        'unload_place_name',
        'cargo_weight',
        'description',
        'is_full_charter',
        'is_moderated',
        'load_city',
        'unload_city',
        'load_region',
        'unload_region',
        'creator_id'
    ];

    const SORT = [
        'tariff',
        'distance'
    ];

    public static function sortFields(): array {
        return self::SORT;
    }

    public function loadTypes(): BelongsToMany
    {
        return $this->belongsToMany(LoadType::class, 'order_load_types', 'order_id', 'load_type_id');
    }

    public function unloadMethods(): BelongsToMany
    {
        return $this->belongsToMany(UnloadMethod::class, 'order_unload_methods', 'order_id', 'unload_method_id');
    }
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function setAttribute($key, $value)
    {
        if ($this->isFloatAttribute($key)) {
            $value = str_replace(',', '.', $value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Check if the given attribute is a float.
     *
     * @param  string  $key
     * @return bool
     */
    protected function isFloatAttribute($key)
    {
        return in_array($key, $this->getFloatAttributes(), true);
    }

    /**
     * Get the float attributes for the model.
     *
     * @return array
     */
    protected function getFloatAttributes()
    {
        return [

            'height_limit',
            'scale_length',
            // и так далее
        ];
    }

}
