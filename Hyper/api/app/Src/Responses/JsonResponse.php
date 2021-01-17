<?php


namespace App\Src\Responses;

use function Sentry\captureException;

class JsonResponse implements IResponse
{
    /**
     * @param array $data
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function ok(array $data, int $statusCode = 200)
    {
        return response()->json($data, $statusCode);
    }

    /**
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public static function notOk(string $message, int $statusCode = 500)
    {
        return self::ok(['message' => $message], $statusCode);
    }

    /**
     * @param \Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public static function notOkException(\Exception $exception)
    {
        captureException($exception);

        return self::notOk($exception->getMessage(), 500);
    }
}
