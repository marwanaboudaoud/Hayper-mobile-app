<?php

/**
 * @OA\POST(
 *     path="/api/signing-up-my-friend/",
 *     tags={"Friend"},
 *     summary="Sign up a friend",
 *     security={{"api_key": {}}},
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="age",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="phone",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="location",
 *                     type="string"
 *                 ),
 *                 example={"name": "Your friendsname", "age": "18", "phone": "Your friends phonenumber",
 *                          "location": "Location"
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
