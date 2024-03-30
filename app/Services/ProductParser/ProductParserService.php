<?php

namespace App\Services\ProductParser;

use App\Enums\ParserProductTypeEnum;
use App\Http\Requests\ProductParser\GetProductFilterRequest;
use App\Models\Product;
use App\Models\ProductLog;
use App\Services\ProductParser\Client\RifClient;
use App\Services\ProductParser\Parser\RifParser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductParserService
{

    private function arrayLevelDrop(array $arr): array
    {
        $temp = [];

        foreach ($arr as $item) {
            $temp = array_merge($temp, $item);
        }

        $arr = $temp;

        $arr = array_values($arr);

        return $arr;
    }

    private function product_rules()
    {
        return [
            'attr'          => ['string', 'required'],
            'company'       => ['string', 'required'],
            'price'         => ['decimal:2', 'required'],
            'type'          => ['integer', 'required'],
            'gluten'        => ['string'],
            'idk'           => ['string'],
            'chp'           => ['string'],
            'nature'        => ['string'],
            'humidity'      => ['string'],
            'weed_impurity' => ['string'],
            'chinch'        => ['string'],
        ];
    }

    private function product_log_rules()
    {
        return [
            'product_id' => ['integer', 'exists:products,id', 'required'],
            'price'      => ['decimal:2', 'required'],
        ];
    }

    public function saveAndParse($count_from, $count_to, $type)
    {
        $data = $this->parse($count_from, $count_to, $type);
        $this->save($data);
    }

    private function save($data)
    {
        foreach ($data as $item) {
            if (!array_key_exists('gluten', $item)) {
                $item['gluten'] = null;
            }
            if ($item['name'] == 'Ячмень') {
                $product_data = [
                    'attr'   => $item['attr'],
                    'name'   => $item['name'],
                    'class'  => $item['class'],
                    'type'   => $item['type'],
                    'nature' => $item['nature']
                ];
            }
            $product_data = [
                'attr'  => $item['attr'],
                'name'  => $item['name'],
                'class' => $item['class'],
                'type'  => $item['type']
            ];
            Validator::make($product_data, $this->product_rules());
            $product = Product::updateOrCreate(
                $product_data,
                [
                    'attr'          => $item['attr'],
                    'name'          => $item['name'],
                    'class'         => $item['class'],
                    'type'          => $item['type'],
                    'gluten'        => $item['gluten'],
                    'idk'           => $item['idk'],
                    'chp'           => $item['chp'],
                    'nature'        => $item['nature'],
                    'humidity'      => $item['humidity'],
                    'weed_impurity' => $item['weed_impurity'],
                    'chinch'        => $item['chinch'],
                    'company'       => $item['company'],
                    'price'         => $item['price'],
                    'exporter'      => $item['exporter']
                ]
            );
            $product_log_data = [
                'product_id' => $product->id,
                'price'      => $item['price'],
                'created_at' => Carbon::now()->startOfDay(),
            ];
            Validator::make($product_log_data, $this->product_log_rules());
            ProductLog::updateOrCreate(['product_id' => $product->id, 'created_at' => Carbon::now()->startOfDay()],
                $product_log_data);
        }
    }

    public function parse($count_from, $count_to, $type)
    {
        $parser = new RifParser($count_from, $count_to, $type);
        $parser->callParse();
        $data = $parser->getResult();
        return $data = $this->arrayLevelDrop($data);
    }


    public function getFilters(array $data): array
    {
        $types = $data;

        if ($types == null) {
            return [];
        }

        $filters = [];
        foreach ($types as $type) {
            $filters[$type] = Product::getProductFilters($type);
        }
        return $filters;
    }


}
