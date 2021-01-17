<?php

/**
 * @OA\POST(
 *     path="/api/projects",
 *     tags={"Projects"},
 *     summary="Search for Projects OR Get all ",
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
 *                     type="array",
 * @OA\Items(
 * @OA\Property(
 *                              property="name",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="active",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="partner_id",
 *                              type="int"
 *                          ),
 *                     ),
 *                 ),
 *                 example={"page": "1", "limit": "3", "order_by": "id", "direction": "asc",
 *                      "search": {"name": "", "active": "", "partner_id": ""}
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
 * @OA\GET(
 *     path="/api/projects/{id}",
 *     tags={"Projects"},
 *     summary="Find project",
 *     security={{"api_key": {}}},
 *     @OA\Parameter(
 *          name="id",
 *          in="path"
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 *     @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */

/**
 * @OA\POST(
 *     path="/api/projects/store",
 *     tags={"Projects"},
 *     summary="Store projects",
 *     security={{"api_key": {}}},
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 *                  @OA\Property(
 *                     property="is_active",
 *                     type="boolean"
 *                  ),
 *                  @OA\Property(
 *                     property="partner_id",
 *                     type="int"
 *                  ),
 *                  @OA\Property(
 *                     property="commission_rates",
 *                     type="array",
 *                     @OA\Items(
 *                          @OA\Property(
 *                              property="rate",
 *                              type="float"
 *                          ),
 *                          @OA\Property(
 *                              property="amount",
 *                              type="float"
 *                          )
 *                     )
 *                  ),
 *                 example={"name": "Webshop school products", "is_active": true, "partner_id": 1,
 *                  "commission_rates": {{"rate": 1.00, "amount": 1.00}}}
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
 *     path="/api/projects/{id}/update",
 *     tags={"Projects"},
 *     summary="Update projects",
 *     security={{"api_key": {}}},
 *     @OA\Parameter(
 *          name="id",
 *          in="path"
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              @OA\Property(
 *               property="name",
 *               type="string"
 *              ),
 *              @OA\Property(
 *               property="is_active",
 *               type="boolean"
 *              ),
 *                 example={"name": "Webshop school products", "is_active": true, "partner_id": 1,
 *                  "commission_rates": {{"rate": 1.00, "amount": 1.00}}}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 *     @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */

/**
 * @OA\POST(
 *     path="/api/projects/{id}/delete",
 *     tags={"Projects"},
 *     summary="Delete project",
 *     security={{"api_key": {}}},
 *     @OA\Parameter(
 *          name="id",
 *          in="path"
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 *     @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */
