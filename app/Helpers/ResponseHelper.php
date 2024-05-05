<?php

use Illuminate\Http\JsonResponse;


if (!function_exists('responseSuccess')) {
    /**
     * @param null $data
     * @param string $message
     * @return JsonResponse
     */
    function responseSuccess($data = null, string $message = "Request processed successfully"): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message
        ];

        if ($data || is_array($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
    }
}

if (!function_exists('responseCreated')) {
    /**
     * @param null $data
     * @param null $message
     */
    function responseCreated($data = null, $message = null): JsonResponse
    {
        $response = [
            'status' => 201,
            'success' => true,
            'message' => $message ?? 'Record created successfully'
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, 201);
    }
}

if (!function_exists('responseCantProcess')) {
    /**
     * @param Throwable|null $t
     * @param string|null $message
     * @return JsonResponse
     */
    function responseCantProcess(Throwable $t = null, string $message = null): JsonResponse
    {
        $response = [
            'status' => $t ? $t->getCode() : null,
            'success' => false,
            'message' => $message ?? ((config('app.debug') && $t)
                    ? $t->getMessage() . '. Location : ' . $t->getFile() . ' at line : ' . $t->getLine()
                    : 'Cannot process request')
        ];
        return response()->json($response, 400);
    }
}

if (!function_exists('responseNotFound')) {
    /**
     * @param string $message
     * @return JsonResponse
     */
    function responseNotFound(string $message = 'Not Found!'): JsonResponse
    {
        $response = [
            'status' => 404,
            'success' => false,
            'message' => $message
        ];
        return response()->json($response, 404);
    }
}
