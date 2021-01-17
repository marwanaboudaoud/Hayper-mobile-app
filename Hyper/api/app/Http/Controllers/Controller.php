<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *     description="This is a API Documentation for Hyper",
     *     version="1.0.0",
     *     title="Sample App API swagger documentation",
     *     termsOfService="http://swagger.io/terms/",
     *     @OA\Contact(
     *         email="apiteam@swagger.io"
     *     ),
     *     @OA\License(
     *         name="Apache 2.0",
     *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *     )
     * )
     */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
