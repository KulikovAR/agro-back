<?php

namespace App\Docs\Transport;

class TransportController
{
    /**
     * @OA\Get(
     *      path="/transport/",
     *      operationId="getTransportList",
     *      tags={"Transport"},
     *      summary="Get list of transports",
     *      description="Returns a list of transports",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="status", type="string", example="OK"),
     *              @OA\Property(property="message", type="string", example=""),
     *              @OA\Property(property="data", type="array", @OA\Items(
     *                  type="array",
     *
     *                  @OA\Items(ref="#/components/schemas/Transport"),
     *              )),
     *          ),
     *      ),
     * )
     */
    public function index()
    {
    }

    /**
     * @OA\Get(
     *      path="/transport/{id}",
     *      operationId="getTransportById",
     *      tags={"Transport"},
     *      summary="Get transport details by ID",
     *      description="Returns details of a specific transport based on the provided ID",
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the transport",
     *
     *          @OA\Schema(type="string", format="uuid"),
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="status", type="string", example="OK"),
     *              @OA\Property(property="message", type="string", example=""),
     *              @OA\Property(property="data", type="array", @OA\Items(
     *                  @OA\Property(property="id", type="string", format="uuid", example="9b519d54-ac2b-4aa3-857c-ff41a3b3e6b3"),
     *                  @OA\Property(property="driver", type="object",
     *                      @OA\Property(property="id", type="string", format="uuid", example="9b519d54-9806-4309-bb3e-0462a96ac9ed"),
     *                      @OA\Property(property="user", type="object",
     *                          @OA\Property(property="id", type="string", format="uuid", example="9b519d54-8747-4b84-8b82-44e2cfa8dc63"),
     *                          @OA\Property(property="phone_number", type="string", example="+7000510238"),
     *                          @OA\Property(property="code", type="string", example="836"),
     *                          @OA\Property(property="code_hash", type="string", example="$2y$12$ZH2B1ILNMZf8SX8v58pWROfM340JbuYAWuN9NzXW02NJaxQKFzSzO"),
     *                          @OA\Property(property="phone_verified_at", type="string", format="date-time", example="2024-02-12T14:32:21.000000Z"),
     *                      ),
     *                      @OA\Property(property="company_id", type="string", format="uuid", example="27f7468a-f4a6-4e3f-bfa1-b621c7a4d17e"),
     *                      @OA\Property(property="is_active", type="integer", example=1),
     *                  ),
     *                  @OA\Property(property="type", type="integer", example=1),
     *                  @OA\Property(property="number", type="string", example="aaa723c"),
     *                  @OA\Property(property="model", type="string", example="Moskvich"),
     *                  @OA\Property(property="description", type="string", example="Tempora."),
     *                  @OA\Property(property="free", type="integer", example=1),
     *                  @OA\Property(property="is_active", type="integer", example=1),
     *                  @OA\Property(property="volume_cm", type="string", example="303"),
     *                  @OA\Property(property="capacity", type="integer", example=5713029),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-12T14:32:22.000000Z"),
     *              )),
     *          ),
     *      ),
     * )
     */
    public function show()
    {
    }

    /**
     * @OA\Post(
     *      path="/transport/create",
     *      operationId="createTransport",
     *      tags={"Transport"},
     *      summary="Create a new transport",
     *      description="Creates a new transport with the provided data",
     *
     *      @OA\RequestBody(
     *          required=true,
     *          description="Transport data",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="driver_id", type="uuid", example="9b519d54-9806-4309-bb3e-0462a96ac9ed"),
     *              @OA\Property(property="type", type="integer", example=1),
     *              @OA\Property(property="number", type="string", example="aaa723c"),
     *              @OA\Property(property="model", type="string", example="Moskvich"),
     *              @OA\Property(property="description", type="string", example="Tempora."),
     *              @OA\Property(property="free", type="integer", example=1),
     *              @OA\Property(property="is_active", type="integer", example=1),
     *              @OA\Property(property="volume_cm", type="string", example="303"),
     *              @OA\Property(property="capacity", type="integer", example=5713029),
     *              @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-12T14:32:22.000000Z"),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="status", type="string", example="OK"),
     *              @OA\Property(property="message", type="string", example=""),
     *              @OA\Property(property="data", type="array", @OA\Items(
     *                  @OA\Property(property="id", type="string", format="uuid", example="9b519d54-ac2b-4aa3-857c-ff41a3b3e6b3"),
     *                  @OA\Property(property="driver", type="object",
     *                      @OA\Property(property="id", type="string", format="uuid", example="9b519d54-9806-4309-bb3e-0462a96ac9ed"),
     *                      @OA\Property(property="user", type="object",
     *                          @OA\Property(property="id", type="string", format="uuid", example="9b519d54-8747-4b84-8b82-44e2cfa8dc63"),
     *                          @OA\Property(property="phone_number", type="string", example="+7000510238"),
     *                          @OA\Property(property="code", type="string", example="836"),
     *                          @OA\Property(property="code_hash", type="string", example="$2y$12$ZH2B1ILNMZf8SX8v58pWROfM340JbuYAWuN9NzXW02NJaxQKFzSzO"),
     *                          @OA\Property(property="phone_verified_at", type="string", format="date-time", example="2024-02-12T14:32:21.000000Z"),
     *                      ),
     *                      @OA\Property(property="company_id", type="string", format="uuid", example="27f7468a-f4a6-4e3f-bfa1-b621c7a4d17e"),
     *                      @OA\Property(property="is_active", type="integer", example=1),
     *                  ),
     *                  @OA\Property(property="type", type="integer", example=1),
     *                  @OA\Property(property="number", type="string", example="aaa723c"),
     *                  @OA\Property(property="model", type="string", example="Moskvich"),
     *                  @OA\Property(property="description", type="string", example="Tempora."),
     *                  @OA\Property(property="free", type="integer", example=1),
     *                  @OA\Property(property="is_active", type="integer", example=1),
     *                  @OA\Property(property="volume_cm", type="string", example="303"),
     *                  @OA\Property(property="capacity", type="integer", example=5713029),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-12T14:32:22.000000Z"),
     *              )),
     *          ),
     *      ),
     * )
     */
    public function create()
    {
    }

    /**
     * @OA\Put(
     *      path="/transport/update/{id}",
     *      operationId="updateTransport",
     *      tags={"Transport"},
     *      summary="Update an existing transport",
     *      description="Updates an existing transport based on the provided ID",
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the transport",
     *
     *          @OA\Schema(type="string", format="uuid"),
     *      ),
     *
     *      @OA\RequestBody(
     *          required=true,
     *          description="Transport data for update",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="driver_id", type="string", format="uuid", example="9b519d54-9806-4309-bb3e-0462a96ac9ed"),
     *              @OA\Property(property="type", type="integer", example=1),
     *              @OA\Property(property="number", type="string", example="aaa723c"),
     *              @OA\Property(property="model", type="string", example="Moskvich"),
     *              @OA\Property(property="description", type="string", example="Tempora."),
     *              @OA\Property(property="free", type="integer", example=1),
     *              @OA\Property(property="is_active", type="integer", example=1),
     *              @OA\Property(property="volume_cm", type="string", example="303"),
     *              @OA\Property(property="capacity", type="integer", example=5713029),
     *              @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-12T14:32:22.000000Z"),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="status", type="string", example="OK"),
     *              @OA\Property(property="message", type="string", example=""),
     *              @OA\Property(property="data", type="array", @OA\Items(
     *                  @OA\Property(property="id", type="string", format="uuid", example="9b519d54-ac2b-4aa3-857c-ff41a3b3e6b3"),
     *                  @OA\Property(property="driver", type="object",
     *                      @OA\Property(property="id", type="string", format="uuid", example="9b519d54-9806-4309-bb3e-0462a96ac9ed"),
     *                      @OA\Property(property="user", type="object",
     *                          @OA\Property(property="id", type="string", format="uuid", example="9b519d54-8747-4b84-8b82-44e2cfa8dc63"),
     *                          @OA\Property(property="phone_number", type="string", example="+7000510238"),
     *                          @OA\Property(property="code", type="string", example="836"),
     *                          @OA\Property(property="code_hash", type="string", example="$2y$12$ZH2B1ILNMZf8SX8v58pWROfM340JbuYAWuN9NzXW02NJaxQKFzSzO"),
     *                          @OA\Property(property="phone_verified_at", type="string", format="date-time", example="2024-02-12T14:32:21.000000Z"),
     *                      ),
     *                      @OA\Property(property="company_id", type="string", format="uuid", example="27f7468a-f4a6-4e3f-bfa1-b621c7a4d17e"),
     *                      @OA\Property(property="is_active", type="integer", example=1),
     *                  ),
     *                  @OA\Property(property="type", type="integer", example=1),
     *                  @OA\Property(property="number", type="string", example="aaa723c"),
     *                  @OA\Property(property="model", type="string", example="Moskvich"),
     *                  @OA\Property(property="description", type="string", example="Tempora."),
     *                  @OA\Property(property="free", type="integer", example=1),
     *                  @OA\Property(property="is_active", type="integer", example=1),
     *                  @OA\Property(property="volume_cm", type="string", example="303"),
     *                  @OA\Property(property="capacity", type="integer", example=5713029),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2024-02-12T14:32:22.000000Z"),
     *              )),
     *          ),
     *      ),
     * )
     */
    public function update()
    {
    }

    /**
     * @OA\Delete(
     *      path="/transport/delete/{id}",
     *      operationId="deleteTransport",
     *      tags={"Transport"},
     *      summary="Delete an existing transport",
     *      description="Deletes an existing transport based on the provided ID",
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the transport",
     *
     *          @OA\Schema(type="string", format="uuid"),
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="status", type="string", example="OK"),
     *              @OA\Property(property="message", type="string", example="Транспорт удалён"),
     *              @OA\Property(property="data", type="array", @OA\Items()),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=404,
     *          description="Transport not found",
     *
     *          @OA\JsonContent(
     *              type="object",
     *
     *              @OA\Property(property="status", type="string", example="error"),
     *              @OA\Property(property="message", type="string", example="Transport not found"),
     *              @OA\Property(property="data", type="array", @OA\Items()),
     *          ),
     *      ),
     * )
     */
    public function delete()
    {
    }
}
