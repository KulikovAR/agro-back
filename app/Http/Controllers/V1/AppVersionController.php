<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\AppVersionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="App Version",
 *     description="API endpoints for app version management"
 * )
 */
class AppVersionController extends Controller
{
    public function __construct(
        private AppVersionService $appVersionService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/v1/app-version/latest",
     *     summary="Получить самую актуальную версию приложения",
     *     tags={"App Version"},
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Версия получена успешно"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="version", type="string", example="1.0.0"),
     *                 @OA\Property(property="needs_update", type="boolean", example=false)
     *             )
     *         )
     *     )
     * )
     */
    public function getLatestVersion(Request $request): JsonResponse
    {
        $user = Auth::user();
        $latestVersion = $this->appVersionService->getLatestVersion();
        $needsUpdate = $this->appVersionService->needsUpdate($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Версия получена успешно',
            'data' => [
                'version' => $latestVersion,
                'needs_update' => $needsUpdate
            ]
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/app-version/save",
     *     summary="Сохранить текущую версию приложения пользователя",
     *     tags={"App Version"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"version"},
     *             @OA\Property(property="version", type="string", example="1.0.0", description="Версия приложения")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Версия сохранена успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Версия сохранена успешно"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="version", type="string", example="1.0.0")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Ошибка валидации"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function saveVersion(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'version' => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $version = $request->input('version');

        $success = $this->appVersionService->saveUserVersion($user, $version);

        if (!$success) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ошибка сохранения версии'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Версия сохранена успешно',
            'data' => [
                'version' => $version
            ]
        ]);
    }
}
