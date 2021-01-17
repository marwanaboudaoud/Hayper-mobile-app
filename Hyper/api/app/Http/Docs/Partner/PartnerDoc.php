<?php

/**
 * @OA\POST(
 *     path="/api/partners",
 *     tags={"Partners"},
 *     summary="Search for partners OR Get all ",
 *     security={{"api_key": {}}},
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="page",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="limit",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="order_by",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="direction",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="search",
 *                     type="object",
 * @OA\Items(
 * @OA\Property(
 *                              property="id",
 *                              type="int"
 *                          ),
 * @OA\Property(
 *                              property="name",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="address",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="house_number",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="postcode",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="city",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="phone",
 *                              type="string"
 *                          ),
 *                     ),
 *                 ),
 *                 example={"page": "1", "limit": "3", "order_by": "id", "direction": "asc",
 *                              "search": {"id": 1, "name": "", "address": "", "house_number": "",
 *                              "city": "", "phone": ""}
 *                  }
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */

/**
 * @OA\POST(
 *     path="/api/partners/store",
 *     tags={"Partners"},
 *     summary="Register a partner",
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
 *                     property="address",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="house_number",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="postcode",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="city",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="phone",
 *                     type="string"
 *                 ),
 *
 *                 example={"name": "companyName", "address": "Company address", "house_number": "12",
 *                  "postcode": "8224 df",
 *                 "city": "Row", "phone": "01012345678"
 *     }
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *         response="500",
 *         description="Oops something went wrong"
 *     ),
 *
 * )
 */

/**
 * @OA\GET(
 *     path="/api/partners/{id}",
 *     tags={"Partners"},
 *     summary="Find a partner",
 *     security={{"api_key": {}}},
 * @OA\Parameter(
 *          name="id",
 *          in="path"
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */

/**
 * @OA\POST(
 *     path="/api/partners/{id}/update",
 *     tags={"Partners"},
 *     summary="Update partner",
 *     security={{"api_key": {}}},
 *     @OA\Parameter(
 *          name="id",
 *          in="path"
 *     ),
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="address",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="house_number",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="postcode",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="city",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="phone",
 *                     type="string"
 *                 ),
 *
 *                 example={"name": "het oppertje", "address": "lindelaan", "house_number": "99",
 *     "postcode": "2121XV",
 *                 "city": "Almere", "phone": "234535252"}
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     )
 * )
 */

/**
 * @OA\POST(
 *     path="/api/partners/{id}/delete",
 *     tags={"Partners"},
 *     summary="Delete partner",
 *     security={{"api_key": {}}},
 * @OA\Parameter(
 *          name="id",
 *          in="path"
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 * @param         $id
 * @return        \Illuminate\Http\JsonResponse
 */
