<?php

/**
 * @OA\POST(
 *     path="/api/declarations/upload",
 *     tags={"Declaration"},
 *     summary="Upload one declaration",
 *     security={{"api_key": {}}},
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="declaration_type",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="date_of_submission",
 *                     type="date"
 *                 ),
 * @OA\Property(
 *                     property="location",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="amount_exc_vat",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="vat",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="image",
 *                     type="file"
 *                 ),
 *                 example={"declaration_type": "Boodschappen","date_of_submission": "2020-01-22",
 * "location": "Amsterdam", "amount_exc_vat": 22.98,
 *                  "vat": 6, "image": "path"
 *     }
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *         response="409",
 *         description="Employee not found!"
 *     ),
 * @OA\Response(
 *         response="422",
 *         description="Token not set! Or data not valid!"
 *     ),
 *
 * )
 */
