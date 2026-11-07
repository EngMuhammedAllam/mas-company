<?php
namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseTrait
{

    public static function sendResponseError($data = null, int $code = Response::HTTP_INTERNAL_SERVER_ERROR, string $message = "Internal Server Error")
    {
        return response()->json([
            'code' => $code,
            'status' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Json Response
     *
     * Used To Return Json Data
     * @param string|null $message
     * @param array|null $data
     * @param int|null $code
     * @return JsonResponse
     */
    public static function jsonResponseSuccess($data = null, string|null $message = null, int|null $code = null): JsonResponse
    {
        $code ??= Response::HTTP_OK;
        $message ??= "success";
        $status = true;
        return response()->json(compact('code', 'status', 'message', 'message', 'data'), $code);
    }

}
