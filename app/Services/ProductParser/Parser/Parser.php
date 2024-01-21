<?php

namespace App\Services\ProductParser\Parser;

use App\Enums\ParserEnum;
use App\Enums\ParserProductTypeEnum;
use phpQuery;
use phpQueryObject;

class Parser
{
    private $prices;
    private phpQueryObject $document;
    public function __construct(
        $document,
        private int $count_from,
        private int $count_to,
        private array $arr = [],
    ) {
        $this->document = phpQuery::newDocumentHTML($document);
        $this->prices = $this->document->find('body .price');
    }

    public function getResult()
    {
        return $this->arr;
    }
    public function callParse()
    {
        $this->parse(ParserProductTypeEnum::WHEAT->value);
    }
    private function parse($type)
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
                        // Название
                        $this->getName($products_pq, $k, $count, $key);


                        // Характеристики
                        $this->getAttributes($products_pq, $k, $count, $key);

                        $this->getDescription($products_pq, $k, $count, $key);

                        $this->getEntity($count, $k, $key, 'company', $company);
                        $this->getEntity($count, $k, $key, 'type', $type);
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
            $this->getElementInDescription($d, '≥', $count, $k, $key, 'клейковина');
            $this->getElementInDescription($d, '≤', $count, $k, $key, 'ИДК');
            $this->getElementInDescription($d, '≥', $count, $k, $key, 'chp');
            $this->getElementInDescription($d, '≥', $count, $k, $key, 'натура');
            $this->getElementInDescription($d, '≤', $count, $k, $key, 'влажность');
            $this->getElementInDescription($d, '≤', $count, $k, $key, 'сорная примесь');
            $this->getElementInDescription($d, '≤', $count, $k, $key, 'клоп');
        }
    }

    private function getEntity($count, $k, $key, string $entity_key, $entity)
    {
        $this->arr[$count][$k + $key]['entity_key'] = $entity;
    }

    private function getElementInDescription(string $d, string $prefix, $count, $k, $key, string $element_name)
    {
        if (strpos($d, $element_name) === false) {
            return;
        }
        $gluten_arr = explode($prefix, $d);
        $this->arr[$count][$k + $key]['gluten'] = trim($gluten_arr[1], ' ');
    }
}
