<?php

namespace Tests\Unit\Dadata;

use App\Enums\DadataUrlEnum;
use App\Enums\DadataBaseUrlEnum;
use App\Http\Requests\Dadata\DadataSuggestRequest;
use App\Services\Dadata\Dadata;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tests\TestCase;

class DadataTest extends TestCase
{
    private Dadata $dadata;
    public function __construct()
    {  
        $this->dadata = new Dadata;
    }
    public function test_send_full_address_success(): void
    {
        // Мокаем HTTP-запрос с использованием фасада Http
        Http::fake([
            '*' => Http::response(['suggestions' => [
                // Здесь можно добавить ваши моки ответов от Dadata API
                // ...
            ]], 200),
        ]);

        // Создаем экземпляр сервиса

        // Вызываем метод sendFullAddress
        $result = $this->dadata->sendFullAddress('Москва');

        // Проверяем ожидаемые значения
        $this->assertIsArray($result);
        // Добавьте дополнительные утверждения в соответствии с ожидаемым результатом вашего метода
        // ...

        // Проверяем, что HTTP-запрос был выполнен
        Http::assertSent(function ($request) {
            return $request->url() === DadataUrlEnum::API_URL->value . DadataBaseUrlEnum::SUGGEST->value && $request->method() === 'POST';
        });
    }

    public function send_coords_success_test()
    {
        // Мокаем HTTP-запрос с использованием фасада Http
        Http::fake([
            '*' => Http::response(['suggestions' => [
                // Здесь можно добавить ваши моки ответов от Dadata API
                // ...
            ]], 200),
        ]);

        // Вызываем метод sendCoords
        $result = $this->dadata->sendCoords(55.7558, 37.6176, 50);

        // Проверяем ожидаемые значения
        $this->assertIsArray($result);
        // Добавьте дополнительные утверждения в соответствии с ожидаемым результатом вашего метода
        // ...

        // Проверяем, что HTTP-запрос был выполнен
        Http::assertSent(function ($request) {
            return $request->url() === DadataUrlEnum::API_URL->value . DadataBaseUrlEnum::GEOLOCATE->value && $request->method() === 'POST';
        });
    }

    public function get_info_by_inn_success_test()
    {
        // Мокаем HTTP-запрос с использованием фасада Http
        Http::fake([
            '*' => Http::response(['suggestions' => [
                // Здесь можно добавить ваши моки ответов от Dadata API
                // ...
            ]], 200),
        ]);

        // Вызываем метод getInfoByInn
        $result = $this->dadata->getInfoByInn('7707083893'); // Замените на реальный ИНН

        // Проверяем ожидаемые значения
        $this->assertIsArray($result);
        // Добавьте дополнительные утверждения в соответствии с ожидаемым результатом вашего метода
        // ...

        // Проверяем, что HTTP-запрос был выполнен
        Http::assertSent(function ($request) {
            return $request->url() === DadataUrlEnum::API_URL->value . DadataBaseUrlEnum::FIND_BY_INN->value && $request->method() === 'POST';
        });
    }

    public function send_company_success_test()
    {
        // Мокаем успешный HTTP-запрос с фасадом Http
        Http::fake([
            '*' => Http::response(['suggestions' => [
                // Ваш мок успешного ответа от Dadata API
                // ...
            ]], 200),
        ]);

        // Вызываем метод sendCompany
        $result = $this->dadata->sendCompany('сбербанк');

        // Проверяем ожидаемые значения
        $this->assertIsArray($result);
        // Добавьте дополнительные утверждения в соответствии с ожидаемым результатом вашего метода
        // ...

        // Проверяем, что HTTP-запрос был выполнен
        Http::assertSent(function ($request) {
            return $request->url() === DadataUrlEnum::API_URL->value . DadataBaseUrlEnum::CLIENT->value && $request->method() === 'POST';
        });
    }

    public function send_company_false_test()
    {
        // Мокаем неуспешный HTTP-запрос с фасадом Http
        Http::fake([
            '*' => Http::response(['message' => 'Ошибка запроса'], 400),
        ]);
        // Ожидаем выброс исключения BadRequestHttpException
        $this->expectException(BadRequestHttpException::class);

        // Вызываем метод sendCompany
        $this->dadata->sendCompany('Invalid Query');
    }

    // public function send_suggest_success_test()
    // {
    //     // Мокаем успешный HTTP-запрос с фасадом Http
    // Http::fake([
    //     '*' => Http::response(['suggestions' => [
    //         // Ваш мок успешного ответа от Dadata API
    //         // ...
    //     ]], 200),
    // ]);

    // // Создаем мок объекта запроса
    // $suggestRequest = new DadataSuggestRequest('путь_к_запросу', ['параметры_запроса']);

    // // Вызываем метод sendSuggest
    // $result = $this->dadata->sendSuggest($suggestRequest);

    // // Проверяем ожидаемые значения
    // $this->assertIsArray($result);
    // // Добавьте дополнительные утверждения в соответствии с ожидаемым результатом вашего метода
    // // ...

    // // Проверяем, что HTTP-запрос был выполнен
    // Http::assertSent(function ($request) use ($suggestRequest) {
    //     return $request->url() === DadataUrlEnum::API_URL_SUGGEST->value . $suggestRequest->url && $request->method() === 'POST';
    // });// Мокаем успешный HTTP-запрос с фасадом Http
    // }

    public function send_phone_success_test()
    {

        // Мокаем успешный HTTP-запрос с фасадом Http
        Http::fake([
            '*' => Http::response([
                // Ваш мок успешного ответа от Dadata API
                // ...
            ], 200),
        ]);

        // Вызываем метод getVehicle
        $result = $this->dadata->getVehicle(['brand' => 'форд фокус']); // Замените на реальный бренд

        // Проверяем ожидаемые значения
        $this->assertIsArray($result);
        // Добавьте дополнительные утверждения в соответствии с ожидаемым результатом вашего метода
        // ...

        // Проверяем, что HTTP-запрос был выполнен
        Http::assertSent(function ($request) {
            return $request->url() === DadataUrlEnum::API_CLEANER_URL->value . 'vehicle' && $request->method() === 'POST';
        });
    }
}
