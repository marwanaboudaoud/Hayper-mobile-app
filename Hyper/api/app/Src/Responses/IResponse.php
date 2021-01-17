<?php


namespace App\Src\Responses;

interface IResponse
{
    public static function ok(array $data);

    public static function notOk(string $message, int $statusCode = 500);

    public static function notOkException(\Exception $exception);
}
