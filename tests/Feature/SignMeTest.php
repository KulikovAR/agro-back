<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\SignMe\SignMe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignMeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example()
    {
        $data = array(
//            'api_key' => "XBV62A0ZFWO9ATMF",
            'name' => "Ваник",
            'surname' => "Габриелян",
            'lastname' => "Ашотович",
            'bdate' => "1996-08-09",
            'gender' => "M",
            'snils' => "15879145522",
            'ps' => "6016",
            'pn' => "994242",
            'pdate' => "2016-09-08",
            'issued' => "Отделением №2 межрайонного отдела УФМС России по Ростовской области в городе Ростове-на-Дону",
            'pcode' => "610-011",
            'region' => "Ростовская Область",
            'city' => "Ростов-на-Дону",
            'street' => "пр-кт 40-летия Победы",
            'house' => "65/6",
            'phone' => "+79185445025",
            'email' => "guskovrus-71@mail.ru",
            'inn' => "616306253080",
            'cogrn' => "323619600140689",
            'company' => "1",
            'esia' => "1",
            'cfaddr' => "344111, Ростовская область, г Ростов-на-Дону, пр-кт 40-летия Победы, д. 65/6, кв. 127",
            'caddr' => "344111, Ростовская область, г Ростов-на-Дону, пр-кт 40-летия Победы, д. 65/6, кв. 127",
            'ceo_surname' => "Габриелян",
            'ceo_name' => "Ваник",
            'cinn' => "616306253080",
            'regtype' => "2",
            'cname' => "ИП Ваник Габриелян Ашотович",
            'cfullname' => "Индивидуальный предпринимаетль Ваник Габриелян Ашотович",
            'ca' => "NKEP12",
            'ct' => "12"
        );
        $signMe = new SignMe();
        dd($signMe->register($data));
//        dd($signMe->prechek('616306253082'));
    }
}
