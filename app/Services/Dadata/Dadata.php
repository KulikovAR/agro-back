<?php

namespace App\Services\Dadata;

use App\Enums\DadataBaseUrlEnum;
use App\Enums\DadataUrlEnum;
use App\Http\Requests\Dadata\DadataRequest;
use App\Http\Requests\Dadata\DadataSuggestRequest;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Dadata
{
    private DadataClient $dadata;

    private DadataTokenResetClient $clean_auth;

    public function __construct()
    {
        $this->dadata = new DadataClient;
        $this->clean_auth = new DadataTokenResetClient;
    }

    /**
     * Отправляет запрос на получение полного адреса.
     *
     * @param string $query - запрос
     * @param int $count - количество результатов (по умолчанию 1)
     * @return array|null - массив с полной информацией об адресе
     */
    public function sendFullAddress($query, $count = 1)
    {
        $params = [
            'query' => $query,
            'count' => $count,
        ];
        $response = $this->dadata->client->post(
            DadataUrlEnum::API_URL->value . DadataBaseUrlEnum::SUGGEST->value,
            $params
        );

        if ($response->successful()) {
            return array_map(function ($item) {
                $city = null;
                $data = $item['data'];

                if ($data['city']) {
                    $city = $data['city'];
                } elseif ($data['settlement_with_type']) {
                    $city = $data['settlement_with_type'];
                }

                return [
                    'lat' => $data['geo_lat'],
                    'lon' => $data['geo_lon'],
                    'city' => $city,
                    'city_type' => $data['city_type'],
                    'region' => $data['region'],
                    'region_type_full' => $data['region_type_full'],
                    'settlement' => $data['settlement'],
                    'settlement_type_full' => $data['settlement_type_full'],
                    'area' => $data['area'],
                ];
            }, json_decode($response->body(), true)['suggestions']);
        }
        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    /**
     * Отправляет запрос на получение адреса по координатам.
     *
     * @param float $lat - широта
     * @param float $lon - долгота
     * @param int $radius - радиус поиска (по умолчанию 50)
     * @return array|null - адрес, соответствующий координатам
     */
    public function sendCoords($lat, $lon, $radius = 50)
    {
        $params = [
            'lat' => $lat,
            'lon' => $lon,
            'radius_meters' => $radius,
        ];

        $response = $this->dadata->client->post(
            DadataUrlEnum::API_URL->value . DadataBaseUrlEnum::GEOLOCATE->value,
            $params
        );
        if ($response->successful()) {
            dd([
                'address' => (json_decode($response->body(), true)['suggestions']),
            ]);
        }
        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    /**
     * Получение информации по ИНН.
     *
     * @param string $inn - ИНН
     * @return array|null - информация, соответствующая ИНН
     */
    public function getInfoByInn($inn): ?array
    {
        $params = [
            'query' => $inn,
        ];

        $response = $this->dadata->client->post(
            DadataUrlEnum::API_URL->value . DadataBaseUrlEnum::FIND_BY_INN->value,
            $params
        );
        if ($response->successful()) {
            return isset(json_decode($response->body(), true)['suggestions']) ? json_decode(
                $response->body(),
                true
            )['suggestions'] : null;
        }
        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    /**
     * Отправляет кастомный запрос.
     *
     * @param DadataRequest $request - объект запроса
     * @return object - результат запроса в виде объекта
     */
    public function sendRequest(DadataRequest $request)
    {
        $response = $this->dadata->client->post($request->path, $request->body);
        if ($response->successful()) {
            return json_decode($response->body());
        }
        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    /**
     * Отправляет запрос на поиск организации.
     *
     * @param string $query - запрос
     * @return array - массив с организациями, соответствующими запросу
     */
    public function sendCompany(string $query): array
    {
        $params = [
            'query' => $query,
            'count' => 10,
            'status' => ['ACTIVE'],
        ];
        $response = $this->dadata->client->post(
            DadataUrlEnum::API_URL->value . DadataBaseUrlEnum::CLIENT->value,
            $params
        );

        if ($response->successful()) {
            return $data = json_decode($response->body(), true)['suggestions'];
        }
        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    public function sendCompanyForFilament(string $query, string $param, bool $is_search_in_data = false): array
    {
        $arr = [];
        $params = [
            'query' => $query,
            'count' => 10,
            'status' => ['ACTIVE'],
        ];
        $response = $this->dadata->client->post(
            DadataUrlEnum::API_URL->value . DadataBaseUrlEnum::CLIENT->value,
            $params
        );

        if ($response->successful()) {
            $data = json_decode($response->body(), true)['suggestions'];
            if (!$is_search_in_data) {
                foreach ($data as $item) {
                    $arr[] = $item[$param];
                }

                return $arr;
            }
            foreach ($data as $item) {
                $arr[] = $item['data'][$param];
            }

            return $arr;
        }
        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    /**
     * Отправляет запрос с подсказками.
     *
     * @param DadataSuggestRequest $request - объект запроса с подсказками
     * @return array - массив с предложениями/подсказками
     */
    public function sendSuggest(DadataSuggestRequest $request)
    {
        $response = $this->dadata->client->post(DadataUrlEnum::API_URL_SUGGEST->value . $request->url, $request->body);

        if ($response->successful()) {
            return json_decode($response->body(), true)['suggestions'];
        }
        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    /**
     * Получает информацию о транспортном средстве.
     *
     * @param array $brand - массив с информацией о марке транспортного средства
     */
    public function getVehicle(array $brand)
    {
        $response = $this->clean_auth->client->post(DadataUrlEnum::API_CLEANER_URL->value . 'vehicle', $brand);
        if ($response->successful()) {
            return json_decode($response->body(), true);
        }
        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    /**
     * Отправляет запрос на очистку и стандартизацию телефонного номера с использованием Dadata API.
     *
     * @param array $phone Массив, содержащий телефонный номер для обработки.
     * @return array Результат запроса в виде массива, если запрос успешен.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     *                                                                         В случае неуспешного запроса выбрасывается исключение с сообщением об ошибке.
     */
    public function sendPhone(array $phone)
    {
        $response = $this->clean_auth->client->post(DadataUrlEnum::API_CLEANER_URL->value . 'phone', $phone);
        if ($response->successful()) {
            return json_decode($response->body(), true);
        }

        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    /**
     * Отправляет запрос на очистку и валидацию телефонного номера с использованием Dadata API.
     *
     * @param array $phone Массив, содержащий телефонный номер для обработки.
     *                        Пример: ['phone' => '+7 (123) 456-7890']
     * @return array Результат запроса в виде ассоциативного массива.
     *               Пример успешного результата: ['result' => 'cleaned_phone_number']
     *
     * @throws BadRequestHttpException В случае неудачного запроса выбрасывается исключение с сообщением об ошибке.
     */
    public function sendPassport(array $passport)
    {
        $response = $this->clean_auth->client->post(DadataUrlEnum::API_CLEANER_URL->value . 'passport', $passport);
        if ($response->successful()) {
            return json_decode($response->body(), true);
        }

        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    /**
     * Отправляет запрос на очистку и валидацию адреса с использованием Dadata API.
     *
     * @param array $query Массив, содержащий информацию об адресе для обработки.
     *                        Пример: ['address' => 'г. Москва, ул. Примерная, д. 123']
     * @return array Результат запроса в виде ассоциативного массива с координатами.
     *               Пример успешного результата: ['lat' => 55.123456, 'lon' => 37.654321]
     *
     * @throws BadRequestHttpException В случае неудачного запроса выбрасывается исключение с сообщением об ошибке.
     */
    public function sendAddress(array $query): array
    {
        $response = $this->clean_auth->client->post(DadataUrlEnum::API_CLEANER_URL->value . 'address', $query);
        if ($response->successful()) {
            return [
                'lat' => $this->decodeBodyItem($response, 'geo_lat'),
                'lon' => $this->decodeBodyItem($response, 'geo_lon'),
            ];
        }
        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    /**
     * Отправляет запрос на очистку и валидацию адреса с использованием Dadata API
     * и возвращает ассоциативный массив с различными элементами адреса.
     *
     * @param array $query Массив, содержащий информацию об адресе для обработки.
     *                        Пример: ['address' => 'г. Москва, ул. Примерная, д. 123']
     * @return array Ассоциативный массив с элементами адреса.
     *               Пример успешного результата:
     *               [
     *               "country" => "Россия",
     *               "region" => "Московская область",
     *               "city" => "Москва",
     *               "street" => "Примерная",
     *               "street_with_type" => "ул. Примерная",
     *               "house" => "123",
     *               "room" => "Квартира 456",
     *               "postal_code" => "123456",
     *               "region_code" => "50",
     *               "region_with_type" => "Московская область",
     *               "federal_district" => "Центральный федеральный округ",
     *               "kladr_id" => "5000000000000",
     *               "city_kladr_id" => "7700000000000",
     *               ]
     *
     * @throws BadRequestHttpException В случае неудачного запроса выбрасывается исключение с сообщением об ошибке.
     */
    public function getAddressArray(array $query)
    {
        $response = $this->dadata->client->post(DadataUrlEnum::API_URL->value . DadataBaseUrlEnum::SUGGEST->value, $query);

        if ($response->successful()) {
            $data = json_decode($response, true);
            $data = $data['data']['suggestions'][0]['data'];
            Log::info($data);
            return [
                'source' => $data['result'] ?? null,
                "country" => $data["country"] ?? null,
                "region" => $data["region"] ?? null,
                "city" => $data["city"] ?? null,
                "street" => $data["street"],
                "street_with_type" => $data["street_with_type"] ?? null,
                "house" => $data["house"] ?? null,
                "room" => $data["flat"] ?? null,
                "postal_code" => $data["postal_code"] ?? null,
                "region_code" => substr($data["tax_office_legal"] ?? null, 0, 2),
                "region_with_type" => $data["region_with_type"] ?? null,
                "federal_district" => $data["federal_district"] ?? null,
                "flat" => $data["flat"] ?? null,
                "kladr_id" => $data["kladr_id"] ?? null,
                "city_kladr_id" => $data["city_kladr_id"] ?? null,
                "region_kladr_id" => $data["region_kladr_id"] ?? null,
            ];

        }
        throw new BadRequestHttpException(json_decode($response->body())->message);
    }

    private function decodeBodyItem($response, $item)
    {
        return json_decode($response->body(), true)[0][$item];
    }
}
