<?php

namespace App\Traits;

use App\Models\Product;

trait DistinctValueTrait
{
    public static function getProductFilters($name)
    {
        $products = Product::distinct()->select($name)->orderBy($name)->whereNotNull($name)->get();
        $filters = [];
        foreach ($products as $key => $product) {
            $filters[$key]['label'] = $product->$name;
            $filters[$key]['value'] = $product->$name;
        }

        return $filters;
    }
}
