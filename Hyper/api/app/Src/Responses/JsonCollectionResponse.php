<?php


namespace App\Src\Responses;

class JsonCollectionResponse extends JsonResponse
{
    public static function ok(array $data, int $statusCode = 200)
    {
        $data = ['results' => $data];

        return parent::ok($data, $statusCode);
    }
}
