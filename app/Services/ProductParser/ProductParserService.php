<?php
namespace App\Services\ProductParser;

use App\Http\Requests\ProductParser\GetProductFilterRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductParserService
{
    public function getFilters(array $data):array
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