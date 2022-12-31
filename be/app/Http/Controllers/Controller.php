<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    /**
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function jsonFailResponseStatic(string $message = '', int $code = 500){
        $controller = new static();
        return $controller->jsonFailResponse($message, $code);
    }

    /**
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(mixed $data, string $message = '', int $code = 200){
        return response()->json([
            'data' => $data,
            'status' => true,
            'message' => $message,
        ], $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonFailResponse(string $message = '', int $code = 500){
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }
}
