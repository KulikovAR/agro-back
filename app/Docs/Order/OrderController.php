<?php

namespace App\Docs\Order;

class OrderController
{

    /**
     * @OA\Get(
     *      path="/orders",
     *      operationId="getOrdersList",
     *      tags={"Orders"},
     *      summary="Get list of orders",
     *      description="Returns list of orders",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="OK"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Заявки получены"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="id",
     *                          type="string",
     *                          example="9bb029ec-7092-40ea-9e88-b647c278e05f"
     *                      ),
     *                      @OA\Property(
     *                          property="start_order_at",
     *                          type="string",
     *                          example="30.03.24"
     *                      ),
     *                      @OA\Property(
     *                          property="deadlines",
     *                          type="string",
     *                          example="30.03.24-05.04.24"
     *                      ),
     *                      @OA\Property(
     *                          property="distance",
     *                          type="integer",
     *                          example=50
     *                      ),
     *                      @OA\Property(
     *                          property="crop",
     *                          type="string",
     *                          example="corn"
     *                      ),
     *                      @OA\Property(
     *                          property="tariff",
     *                          type="integer",
     *                          example=500
     *                      ),
     *                      @OA\Property(
     *                          property="cargo_weight",
     *                          type="integer",
     *                          example=800
     *                      ),
     *                      @OA\Property(
     *                          property="load_place_name",
     *                          type="string",
     *                          example="Warehouse A"
     *                      ),
     *                      @OA\Property(
     *                          property="unload_place_name",
     *                          type="string",
     *                          example="Warehouse A"
     *                      ),
     *               @OA\Property(property="is_full_charter", type="boolean", example="true"),
     *               @OA\Property(property="unload_method", type="string", example="pricep"),
     *               @OA\Property(property="status", type="string", example="Активная"),
     *                      @OA\Property(
     *                          property="order_number",
     *                          type="integer",
     *                          example=0
     *                      ),
     *                      @OA\Property(
     *                          property="load_coordinates",
     *                          type="object",
     *                          @OA\Property(
     *                              property="x",
     *                              type="string",
     *                              example="-74.0060"
     *                          ),
     *                          @OA\Property(
     *                              property="y",
     *                              type="string",
     *                              example="40.7128"
     *                          ),
     *                      ),
     *                      @OA\Property(
     *                          property="unload_coordinates",
     *                          type="object",
     *                          @OA\Property(
     *                              property="x",
     *                              type="string",
     *                              example="-87.6298"
     *                          ),
     *                          @OA\Property(
     *                              property="y",
     *                              type="string",
     *                              example="41.8781"
     *                          ),
     *                      ),
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    public function index()
    {

    }

    /**
     * @OA\Get(
     *      path="/orders/{id}",
     *      operationId="getOrderById",
     *      tags={"Orders"},
     *      summary="Get order by ID",
     *      description="Returns a single order by its ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the order",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="OK"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Заявка получена"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="crop",
     *                          type="string",
     *                          example="et"
     *                      ),
     *                      @OA\Property(
     *                          property="volume",
     *                          type="string",
     *                          example="qui"
     *                      ),
     *                      @OA\Property(
     *                          property="distance",
     *                          type="integer",
     *                          example=37
     *                      ),
     *                      @OA\Property(
     *                          property="tariff",
     *                          type="integer",
     *                          example=79
     *                      ),
     *                      @OA\Property(
     *                          property="nds_percent",
     *                          type="integer",
     *                          example=90
     *                      ),
     *                      @OA\Property(
     *                          property="terminal_name",
     *                          type="string",
     *                          example="Schuster LLC"
     *                      ),
     *                      @OA\Property(
     *                          property="terminal_address",
     *                          type="string",
     *                          example="1564 Doyle Point Apt. 923\nEast Augustashire, MD 95825"
     *                      ),
     *                      @OA\Property(
     *                          property="terminal_inn",
     *                          type="string",
     *                          example="9188393931"
     *                      ),
     *                      @OA\Property(
     *                          property="exporter_name",
     *                          type="string",
     *                          example="Izabella Batz Sr."
     *                      ),
     *                      @OA\Property(
     *                          property="exporter_inn",
     *                          type="string",
     *                          example="5762204790"
     *                      ),
     *                      @OA\Property(
     *                          property="is_semi_truck",
     *                          type="boolean",
     *                          example=true
     *                      ),
     *                      @OA\Property(
     *                          property="is_tonar",
     *                          type="boolean",
     *                          example=false
     *                      ),
     *                      @OA\Property(
     *                          property="scale_length",
     *                          type="integer",
     *                          example=10
     *                      ),
     *                      @OA\Property(
     *                          property="height_limit",
     *                          type="integer",
     *                          example=8
     *                      ),
     *                      @OA\Property(
     *                          property="is_overload",
     *                          type="boolean",
     *                          example=false
     *                      ),
     *                      @OA\Property(
     *                          property="timeslot",
     *                          type="string",
     *                          example="est"
     *                      ),
     *                      @OA\Property(
     *                          property="outage_begin",
     *                          type="integer",
     *                          example=20
     *                      ),
     *                      @OA\Property(
     *                          property="outage_price",
     *                          type="integer",
     *                          example=87
     *                      ),
     *                      @OA\Property(
     *                          property="daily_load_rate",
     *                          type="integer",
     *                          example=30
     *                      ),
     *                      @OA\Property(
     *                          property="contact_name",
     *                          type="string",
     *                          example="rem"
     *                      ),
     *                      @OA\Property(
     *                          property="contact_phone",
     *                          type="string",
     *                          example="985.863.6637"
     *                      ),
     *                      @OA\Property(
     *                          property="cargo_shortage_rate",
     *                          type="integer",
     *                          example=84
     *                      ),
     *                      @OA\Property(
     *                          property="unit_of_measurement_for_cargo_shortage_rate",
     *                          type="string",
     *                          example="iste"
     *                      ),
     *                      @OA\Property(
     *                          property="cargo_price",
     *                          type="integer",
     *                          example=6
     *                      ),
     *                      @OA\Property(
     *                          property="load_place",
     *                          type="string",
     *                          example="509 Schuyler Keys\nLake Coralie, ID 51860-3476"
     *                      ),
     *                      @OA\Property(
     *                          property="approach",
     *                          type="string",
     *                          example="Incidunt dolorum est sunt delectus quidem."
     *                      ),
     *                      @OA\Property(
     *                          property="work_time",
     *                          type="string",
     *                          example="Aut deleniti nobis adipisci et illum."
     *                      ),
     *                      @OA\Property(
     *                          property="order_number",
     *                          type="integer",
     *                          example=0
     *                      ),
     *                      @OA\Property(
     *                          property="clarification_of_the_weekend",
     *                          type="string",
     *                          example="magni"
     *                      ),
     *                      @OA\Property(
     *                          property="loader_power",
     *                          type="integer",
     *                          example=18
     *                      ),
     *                      @OA\Property(
     *                          property="load_method",
     *                          type="string",
     *                          example="et"
     *                      ),
     *                      @OA\Property(
     *                          property="tolerance_to_the_norm",
     *                          type="integer",
     *                          example=21
     *                      ),
     *                      @OA\Property(
     *                          property="start_order_at",
     *                          type="string",
     *                          example="06.04.24"
     *                      ),
     *                      @OA\Property(
     *                          property="end_order_at",
     *                          type="string",
     *                          example="20.04.24"
     *                      ),
     *                      @OA\Property(
     *                          property="load_coordinates",
     *                          type="object",
     *                          @OA\Property(
     *                              property="x",
     *                              type="string",
     *                              example="-3.997162"
     *                          ),
     *                          @OA\Property(
     *                              property="y",
     *                              type="string",
     *                              example="-86.827053"
     *                          ),
     *                      ),
     *                      @OA\Property(
     *                          property="unload_coordinates",
     *                          type="object",
     *                          @OA\Property(
     *                              property="x",
     *                              type="string",
     *                              example="157.599518"
     *                          ),
     *                          @OA\Property(
     *                              property="y",
     *                              type="string",
     *                              example="-17.582172"
     *                          ),
     *                      ),
     *                      @OA\Property(
     *                          property="load_place_name",
     *                          type="string",
     *                          example="nihil"
     *                      ),
     *                      @OA\Property(
     *                          property="unload_place_name",
     *                          type="string",
     *                          example="autem"
     *                      ),
     *                      @OA\Property(
     *                          property="cargo_weight",
     *                          type="integer",
     *                          example=12
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string",
     *                          example="Molestiae enim quidem iure omnis architecto et tempora eos. Ullam dolor quo sit aliquid. Cumque quae repellat quam cum esse eaque. Dolor rerum praesentium dolorum aut. Quia voluptates illo ut enim vel qui exercitationem."
     *                      ),
     *                   @OA\Property(property="is_full_charter", type="boolean", example="true"),
     *                   @OA\Property(property="unload_method", type="string", example="pricep"),
     *                   @OA\Property(property="status", type="string", example="Активная"),
     *                      @OA\Property(
     *                          property="load_types",
     *                          type="array",
     *                          @OA\Items(
     *                              @OA\Property(
     *                                  property="id",
     *                                  type="string",
     *                                  example="9bb222c4-9fca-4b95-91a3-08e79f51b703"
     *                              ),
     *                              @OA\Property(
     *                                  property="title",
     *                                  type="string",
     *                                  example="maiores"
     *                              ),
     *                          ),
     *                      ),
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Order not found"
     *      )
     * )
     */
    public function show()
    {

    }

    /**
     * @OA\Post(
     *      path="/orders/create",
     *      operationId="createOrder",
     *      tags={"Orders"},
     *      summary="Create a new order",
     *      description="Creates a new order with the provided data",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Order data",
     *          @OA\JsonContent(
     *              required={"crop","volume","distance","tariff","nds_percent","terminal_name","terminal_address","terminal_inn","exporter_name","exporter_inn","is_semi_truck","is_tonar","scale_length","height_limit","is_overload","timeslot","outage_begin","outage_price","daily_load_rate","contact_name","contact_phone","cargo_shortage_rate","unit_of_measurement_for_cargo_shortage_rate","cargo_price","load_place","approach","work_time","clarification_of_the_weekend","loader_power","load_method","tolerance_to_the_norm","start_order_at","end_order_at","load_latitude","load_longitude","unload_latitude","unload_longitude","load_place_name","unload_place_name","cargo_weight","description","load_types"},
     *              @OA\Property(property="crop", type="string", example="corn"),
     *              @OA\Property(property="volume", type="string", example="1000 kg"),
     *              @OA\Property(property="distance", type="integer", example=50),
     *              @OA\Property(property="tariff", type="integer", example=500),
     *              @OA\Property(property="nds_percent", type="integer", example=20),
     *              @OA\Property(property="terminal_name", type="string", example="Terminal A"),
     *              @OA\Property(property="terminal_address", type="string", example="123 Main St, City"),
     *              @OA\Property(property="terminal_inn", type="string", example="1234567890"),
     *              @OA\Property(property="exporter_name", type="string", example="Exporter Inc."),
     *              @OA\Property(property="exporter_inn", type="string", example="0987654321"),
     *              @OA\Property(property="is_semi_truck", type="boolean", example=true),
     *              @OA\Property(property="is_tonar", type="boolean", example=false),
     *              @OA\Property(property="scale_length", type="integer", example=5),
     *              @OA\Property(property="height_limit", type="integer", example=3),
     *              @OA\Property(property="is_overload", type="boolean", example=false),
     *              @OA\Property(property="timeslot", type="string", example="morning"),
     *              @OA\Property(property="outage_begin", type="integer", example=8),
     *              @OA\Property(property="outage_price", type="integer", example=100),
     *              @OA\Property(property="daily_load_rate", type="integer", example=200),
     *              @OA\Property(property="contact_name", type="string", example="John Doe"),
     *              @OA\Property(property="contact_phone", type="string", example="+1234567890"),
     *              @OA\Property(property="cargo_shortage_rate", type="integer", example=50),
     *              @OA\Property(property="unit_of_measurement_for_cargo_shortage_rate", type="string", example="kg"),
     *              @OA\Property(property="cargo_price", type="integer", example=300),
     *              @OA\Property(property="load_place", type="string", example="456 Elm St, City"),
     *              @OA\Property(property="approach", type="string", example="from the south"),
     *              @OA\Property(property="work_time", type="string", example="8am - 5pm"),
     *              @OA\Property(property="clarification_of_the_weekend", type="string", example="N/A"),
     *              @OA\Property(property="loader_power", type="integer", example=10),
     *              @OA\Property(property="load_method", type="string", example="crane"),
     *              @OA\Property(property="tolerance_to_the_norm", type="integer", example=10),
     *              @OA\Property(property="start_order_at", type="string", format="date", example="2024-03-30"),
     *              @OA\Property(property="end_order_at", type="string", format="date", example="2024-04-05"),
     *              @OA\Property(property="load_latitude", type="string", example="40.7128"),
     *              @OA\Property(property="load_longitude", type="string", example="-74.0060"),
     *              @OA\Property(property="unload_latitude", type="string", example="41.8781"),
     *              @OA\Property(property="unload_longitude", type="string", example="-87.6298"),
     *              @OA\Property(property="load_place_name", type="string", example="Warehouse A"),
     *              @OA\Property(property="unload_place_name", type="string", example="Warehouse B"),
     *              @OA\Property(property="cargo_weight", type="integer", example=800),
     *              @OA\Property(property="description", type="string", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit."),
     *                   @OA\Property(property="is_full_charter", type="boolean", example="true"),
     *               @OA\Property(property="unload_method", type="string", example="pricep"),
     *              @OA\Property(property="status", type="string", example="Активная"),
     *              @OA\Property(property="load_types", type="array", @OA\Items(type="string", example="type1")),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="OK"),
     *              @OA\Property(property="message", type="string", example="Заявка создана"),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(property="id", type="string", example="9bb23060-4d95-4832-ad93-9dd8170e59e2"),
     *                      @OA\Property(property="order_number", type="null")
     *                  )
     *              )
     *          )
     *      ),
     * )
     */
    public function create()
    {

    }

    /**
     * @OA\Put(
     *      path="/orders/update/{id}",
     *      operationId="updateOrder",
     *      tags={"Orders"},
     *      summary="Update an existing order",
     *      description="Updates an existing order with the provided data",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the order to update",
     *          @OA\Schema(
     *              type="string",
     *              format="uuid"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Order data",
     *          @OA\JsonContent(
     *              required={"crop","volume","distance","tariff","nds_percent","terminal_name","terminal_address","terminal_inn","exporter_name","exporter_inn","is_semi_truck","is_tonar","scale_length","height_limit","is_overload","timeslot","outage_begin","outage_price","daily_load_rate","contact_name","contact_phone","cargo_shortage_rate","unit_of_measurement_for_cargo_shortage_rate","cargo_price","load_place","approach","work_time","clarification_of_the_weekend","loader_power","load_method","tolerance_to_the_norm","start_order_at","end_order_at","load_latitude","load_longitude","unload_latitude","unload_longitude","load_place_name","unload_place_name","cargo_weight","description","load_types"},
     *              @OA\Property(property="crop", type="string", example="corn"),
     *              @OA\Property(property="volume", type="string", example="1000 kg"),
     *              @OA\Property(property="distance", type="integer", example=50),
     *              @OA\Property(property="tariff", type="integer", example=500),
     *              @OA\Property(property="nds_percent", type="integer", example=20),
     *              @OA\Property(property="terminal_name", type="string", example="Terminal A"),
     *              @OA\Property(property="terminal_address", type="string", example="123 Main St, City"),
     *              @OA\Property(property="terminal_inn", type="string", example="1234567890"),
     *              @OA\Property(property="exporter_name", type="string", example="Exporter Inc."),
     *              @OA\Property(property="exporter_inn", type="string", example="0987654321"),
     *              @OA\Property(property="is_semi_truck", type="boolean", example=true),
     *              @OA\Property(property="is_tonar", type="boolean", example=false),
     *              @OA\Property(property="scale_length", type="integer", example=5),
     *              @OA\Property(property="height_limit", type="integer", example=3),
     *              @OA\Property(property="is_overload", type="boolean", example=false),
     *              @OA\Property(property="timeslot", type="string", example="morning"),
     *              @OA\Property(property="outage_begin", type="integer", example=8),
     *              @OA\Property(property="outage_price", type="integer", example=100),
     *              @OA\Property(property="daily_load_rate", type="integer", example=200),
     *              @OA\Property(property="contact_name", type="string", example="John Doe"),
     *              @OA\Property(property="contact_phone", type="string", example="+1234567890"),
     *              @OA\Property(property="cargo_shortage_rate", type="integer", example=50),
     *              @OA\Property(property="unit_of_measurement_for_cargo_shortage_rate", type="string", example="kg"),
     *              @OA\Property(property="cargo_price", type="integer", example=300),
     *              @OA\Property(property="load_place", type="string", example="456 Elm St, City"),
     *              @OA\Property(property="approach", type="string", example="from the south"),
     *              @OA\Property(property="work_time", type="string", example="8am - 5pm"),
     *              @OA\Property(property="clarification_of_the_weekend", type="string", example="N/A"),
     *              @OA\Property(property="loader_power", type="integer", example=10),
     *              @OA\Property(property="load_method", type="string", example="crane"),
     *              @OA\Property(property="tolerance_to_the_norm", type="integer", example=10),
     *              @OA\Property(property="start_order_at", type="string", format="date", example="2024-03-30"),
     *              @OA\Property(property="end_order_at", type="string", format="date", example="2024-04-05"),
     *              @OA\Property(property="load_latitude", type="string", example="40.7128"),
     *              @OA\Property(property="load_longitude", type="string", example="-74.0060"),
     *              @OA\Property(property="unload_latitude", type="string", example="41.8781"),
     *              @OA\Property(property="unload_longitude", type="string", example="-87.6298"),
     *              @OA\Property(property="load_place_name", type="string", example="Warehouse A"),
     *              @OA\Property(property="unload_place_name", type="string", example="Warehouse B"),
     *              @OA\Property(property="cargo_weight", type="integer", example=800),
     *              @OA\Property(property="description", type="string", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit."),
     *              @OA\Property(property="is_full_charter", type="boolean", example="true"),
     *              @OA\Property(property="unload_method", type="string", example="pricep"),
     *              @OA\Property(property="status", type="string", example="Активная"),
     *              @OA\Property(property="load_types", type="array", @OA\Items(type="string", example="type1")),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="OK"),
     *              @OA\Property(property="message", type="string", example="Заявка получена"),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="crop", type="string", example="corn"),
     *                  @OA\Property(property="volume", type="string", example="1000 kg"),
     *                  @OA\Property(property="distance", type="integer", example=50),
     *                  @OA\Property(property="tariff", type="integer", example=500),
     *                  @OA\Property(property="nds_percent", type="integer", example=20),
     *                  @OA\Property(property="terminal_name", type="string", example="Terminal A"),
     *                  @OA\Property(property="terminal_address", type="string", example="123 Main St, City"),
     *                  @OA\Property(property="terminal_inn", type="string", example="1234567890"),
     *                  @OA\Property(property="exporter_name", type="string", example="Exporter Inc."),
     *                  @OA\Property(property="exporter_inn", type="string", example="0987654321"),
     *                  @OA\Property(property="is_semi_truck", type="boolean", example=true),
     *                  @OA\Property(property="is_tonar", type="boolean", example=false),
     *                  @OA\Property(property="scale_length", type="integer", example=5),
     *                  @OA\Property(property="height_limit", type="integer", example=3),
     *                  @OA\Property(property="is_overload", type="boolean", example=false),
     *                  @OA\Property(property="timeslot", type="string", example="morning"),
     *                  @OA\Property(property="outage_begin", type="integer", example=8),
     *                  @OA\Property(property="outage_price", type="integer", example=100),
     *                  @OA\Property(property="daily_load_rate", type="integer", example=200),
     *                  @OA\Property(property="contact_name", type="string", example="John Doe"),
     *                  @OA\Property(property="contact_phone", type="string", example="+1234567890"),
     *                  @OA\Property(property="cargo_shortage_rate", type="integer", example=50),
     *                  @OA\Property(property="unit_of_measurement_for_cargo_shortage_rate", type="string", example="kg"),
     *                  @OA\Property(property="cargo_price", type="integer", example=300),
     *                  @OA\Property(property="load_place", type="string", example="456 Elm St, City"),
     *                  @OA\Property(property="approach", type="string", example="from the south"),
     *                  @OA\Property(property="work_time", type="string", example="8am - 5pm"),
     *                  @OA\Property(property="clarification_of_the_weekend", type="string", example="N/A"),
     *                  @OA\Property(property="loader_power", type="integer", example=10),
     *                  @OA\Property(property="load_method", type="string", example="crane"),
     *                  @OA\Property(property="tolerance_to_the_norm", type="integer", example=10),
     *                  @OA\Property(property="start_order_at", type="string", format="date", example="2024-03-30"),
     *                  @OA\Property(property="end_order_at", type="string", format="date", example="2024-04-05"),
     *                  @OA\Property(property="load_latitude", type="string", example="40.7128"),
     *                  @OA\Property(property="load_longitude", type="string", example="-74.0060"),
     *                  @OA\Property(property="unload_latitude", type="string", example="41.8781"),
     *                  @OA\Property(property="unload_longitude", type="string", example="-87.6298"),
     *                  @OA\Property(property="load_place_name", type="string", example="Warehouse A"),
     *                  @OA\Property(property="unload_place_name", type="string", example="Warehouse B"),
     *                  @OA\Property(property="cargo_weight", type="integer", example=800),
     *                  @OA\Property(property="description", type="string", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit."),
     *                  @OA\Property(property="is_full_charter", type="boolean", example="true"),
     *                  @OA\Property(property="unload_method", type="string", example="pricep"),
     *                  @OA\Property(property="status", type="string", example="Активная"),
     *                  @OA\Property(property="load_types", type="array", @OA\Items(type="string", example="type1")),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Order not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="Error"),
     *              @OA\Property(property="message", type="string", example="Order not found")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Invalid data provided",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="Error"),
     *              @OA\Property(property="message", type="string", example="Invalid data provided")
     *          )
     *      )
     * )
     */

    public function update()
    {

    }

    /**
     * @OA\Delete(
     *      path="/orders/delete/{id}",
     *      operationId="deleteOrder",
     *      tags={"Orders"},
     *      summary="Delete an existing order",
     *      description="Deletes an existing order",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the order to delete",
     *          @OA\Schema(
     *              type="string",
     *              format="uuid"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="OK"),
     *              @OA\Property(property="message", type="string", example="Заявка удалена"),
     *              @OA\Property(property="data", type="array", @OA\Items())
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Order not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="Error"),
     *              @OA\Property(property="message", type="string", example="Order not found")
     *          )
     *      )
     * )
     */

    public function delete()
    {

    }

    /**
     * @OA\Get(
     *     path="/load_types/",
     *     summary="Получить список типов загрузок",
     *     tags={"Load Types"},
     *     @OA\Response(
     *         response=200,
     *         description="Список типов загрузок",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="OK"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Типы загрузок получены"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example="9bb8d29b-7cb0-4180-9eb7-0065d63a0a2d"
     *                     ),
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="Маниту"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function getLoadTypes()
    {

    }


    /**
     * @OA\Get(
     *     path="/orders/regions",
     *     summary="Retrieve a list of regions for orders",
     *     tags={"Orders"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of regions retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="OK"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example=""
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(type="string"),
     *                 example={"Liechtenstein", "Northern Mariana Islands", "Barbados", "Lesotho", "Moldova"}
     *             )
     *         )
     *     ),
     * )
     */

    public function getRegions() {

    }


    /**
     * @OA\Get(
     *     path="/orders/cities",
     *     summary="Retrieve a list of cities for a specific region",
     *     tags={"Orders"},
     *     @OA\Parameter(
     *         name="region",
     *         in="query",
     *         required=true,
     *         description="Name of the region for which cities are to be retrieved",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of cities retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="OK"
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example=""
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(type="string"),
     *                 example={"Emmerichbury"}
     *             )
     *         )
     *     ),
     * )
     */

    public function getCities() {

    }
}
