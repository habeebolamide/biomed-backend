<?php

namespace App\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiResponseMessagesTrait {

    public function success($result, $message = "")
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function created($result, $message = "")
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 201);
    }

    public function nft_response($result)
    {

        return response()->json($result, 200);
    }

    public function error($result)
    {
        $response = [
            'success' => false,
            'data' => $result,
        ];
        return response()->json($response, 408);
    }

    public function notFoundException($message)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
        return response()->json($response, 404);
    }

    public function unProcessedError($message)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, 422);
    }

    public function badRequest($message)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, 400);
    }

    public function badRequestWithData($data, $message)
    {
        $response = [
            'errors' => $data,
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, 400);
    }

    public function noResponse($message='deleted successfully')
    {
        return response()->json(['message' => $message], 204);
    }

    public function forbiddenResponse($message='forbidden')
    {
        return response()->json(['message' => $message], 403);
    }


}
