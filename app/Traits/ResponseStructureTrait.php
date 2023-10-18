<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;

trait ResponseStructureTrait
{
    /**
     * Método protegido para generar una respuesta de error JSON.
     *
     * @param  mixed  $errors
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($errors, int $statusCode): JsonResponse
    {
        return new JsonResponse(['errors' => $errors], $statusCode);
    }

    /**
     * Método protegido para generar una respuesta de éxito JSON.
     *
     * @param  mixed  $message
     * @param  int  $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($message, int $statusCode): JsonResponse
    {
        return new JsonResponse($message, $statusCode);
    }
}
