<?php

namespace App\Services\ProductParser\Parser;

use App\Enums\ParserEnum;
use App\Enums\ParserProductTypeEnum;
use App\Services\ProductParser\Client\RifClient;
use phpQuery;
use phpQueryObject;

class RifParser
{
    private $prices;
    private phpQueryObject $document;
    private array $arr = [];
    public function __construct(
        private int $count_from,
        private int $count_to,
        private int $type,
        private RifClient $client = new RifClient(),
    ) {
        if($type==ParserProductTypeEnum::WHEAT->value)
        {
            $document = $this->client->wheatBodyHttp();
        }
        if($type==ParserProductTypeEnum::BARLEY->value)
        {
            $document = $this->client->barleyBodyHttp();
        }
        $this->document = phpQuery::newDocumentHTML($document);
        $this->prices = $this->document->find('body .price');
    }

    public function getResult()
    {
        return $this->arr;
    }

    public function callParse()
    {
       $this->parse();
    }
    private function parse()
    {
        $count = 0;
        foreach ($this->prices as $k => $price) {
            if ($this->count_from == $count || $this->count_to == $count) {
                $company = '';
                if ($count == $this->count_from) {
                    $company = 'ООО "ТД "РИФ';
                }

                if ($count == $this->count_to) {
                    $company = 'АО "ЗЕРНОВОЙ ТЕРМИНАЛ "КСК"';
                }
                $pg =  pq($price);
                $products = $pg->find('tbody tr');
                foreach ($products as $key => $product) {
                    $products_pq =  pq($product);

                    if ($key % 2 == 0) {


                        $this->productArrayInit($count,$k,$key);
                        // Название
                        $this->getName($products_pq, $k, $count, $key);


                        // Характеристики
                        $this->getAttributes($products_pq, $k, $count, $key);

                        $this->getDescription($products_pq, $k, $count, $key);
                        $this->getEntity($count, $k, $key, 'company', $company);
                        $this->getEntity($count, $k, $key, 'type', $this->type);
                        $this->getEntity($count, $k, $key, 'exporter', ParserEnum::EXPORTER->value);
                    } else {
                        $name = $products_pq->find('td:first')->text();
                        $names = explode(' ', $name);
                        $clean_names = array_diff($names, array('', NULL, false));
                        $clean_names = array_values($clean_names);
                        if (!empty($clean_names)) {
                            $this->arr[$count][$k + $key - 1]['price'] = (float)str_replace(',', '.', $clean_names[1]);
                        }
                    }
                }
            }
            $count++;
        }
    }

    private function getName($products_pq, $k, $count, $key)
    {
        $name = $products_pq->find('th div.name')->text();
        $names = explode(' ', $name);
        $clean_names = array_diff($names, array('', NULL, false));
        $clean_names = array_values($clean_names);
        if (!empty($clean_names)) {
            $this->arr[$count][$k + $key]['name'] = trim($clean_names[1], ',');
            $this->arr[$count][$k + $key]['class'] = isset($clean_names[2]) ? $clean_names[2] : '';
        }
    }
    private function getAttributes($products_pq, $k, $count, $key)
    {
        $attr = $products_pq->find('span span')->text();
        $attrs = explode(' ', $attr);
        $clean_attrs = array_diff($attrs, array('', NULL, false));
        $clean_attrs = array_values($clean_attrs);
        $this->arr[$count][$k + $key]['attr'] = null;
        if (!empty($clean_attrs)) {
            $this->arr[$count][$k + $key]['attr'] = str_replace('.', ',', $clean_attrs[1]);
        }
    }

    private function getDescription($products_pq, $k, $count, $key)
    {
        $descr = $products_pq->find('div.props')->text();
        $descr_arr = explode(';', $descr);

        foreach ($descr_arr as $d) {
            $this->getElementInDescription($d, '≥', $count, $k, $key, 'клейковина','gluten');
            $this->getElementInDescription($d, '≤', $count, $k, $key, 'ИДК','idk');
            $this->getElementInDescription($d, '≥', $count, $k, $key, 'ЧП','chp');
            $this->getElementInDescription($d, '≥', $count, $k, $key, 'натура','nature');
            $this->getElementInDescription($d, '≤', $count, $k, $key, 'влажность','humidity');
            $this->getElementInDescription($d, '≤', $count, $k, $key, 'сорная примесь','weed_impurity');
            $this->getElementInDescription($d, '≤', $count, $k, $key, 'клоп','chinch');
        }
    }

    private function getEntity($count, $k, $key, string $entity_key, $entity)
    {
        $this->arr[$count][$k + $key][$entity_key] = $entity;
    }

    private function getElementInDescription(string $d, string $prefix, $count, $k, $key, string $element_name, string $element_key)
    {
        if (strpos($d, $element_name) === false) {
            return;
        }
        // dd($element_key);
        $gluten_arr = explode($prefix, $d);
        // dd($this->arr[$count][$k+$key]['class']);
        // if(!array_key_exists($element_key,$this->arr[$count][$k+$key])){
        //     $this->arr[$count][$k + $key][$element_key] = null;
        // }
      
        $this->arr[$count][$k + $key][$element_key] = trim($gluten_arr[1], ' ');
        // dd($this->arr[$count][$k+$key]);
     
    }

    private function productArrayInit($count,$k,$key){
        $this->arr[$count][$k + $key]['name'] = null;
        $this->arr[$count][$k + $key]['attr'] = null;
        $this->arr[$count][$k + $key]['class'] = null;
        $this->arr[$count][$k + $key]['exporter'] = null;
        $this->arr[$count][$k + $key]['company'] = null;
        $this->arr[$count][$k + $key]['gluten'] = null;
        $this->arr[$count][$k + $key]['idk'] = null;
        $this->arr[$count][$k + $key]['chp'] = null;
        $this->arr[$count][$k + $key]['nature'] = null;
        $this->arr[$count][$k + $key]['humidity'] = null;
        $this->arr[$count][$k + $key]['weed_impurity'] = null;
        $this->arr[$count][$k + $key]['chinch'] = null;
        $this->arr[$count][$k + $key]['type'] = null;
    }
}
