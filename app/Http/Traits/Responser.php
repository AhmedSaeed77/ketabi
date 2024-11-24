<?php

namespace App\Http\Traits;

trait Responser
{

    private function responseSuccess($status = 200, $message = 'Success', $data = []) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    private function responseFail($status = 422, $message = 'Error', $data = []) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    private function responseCustom($status, $message, $data = []) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }

}
