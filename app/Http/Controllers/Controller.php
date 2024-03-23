<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function successResponse($data=[], $message="success", $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'=>true,
            'message'=>$message,
            'data'=>$data
        ], $statusCode);
    }

    public function errorResponse($data=[], $message="Sorry an error occurred, our engineers has been notified", $errorCode = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'=>false,
            'message'=>$message,
            'data'=>$data
        ], $errorCode);
    }

    public function validationErrorResponse($data=[], $message="Validation failed", $errorCode = 422): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'=>false,
            'message'=>'Validation error',
            'data'=>$data
        ], $errorCode);
    }
}
