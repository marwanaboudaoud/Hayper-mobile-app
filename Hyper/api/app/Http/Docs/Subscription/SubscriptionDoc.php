<?php

/**
 * @OA\POST(
 *     path="/api/subscriptions",
 *     tags={"Subscriptions"},
 *     summary="Search for subscriptions OR Get all ",
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
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="project",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="code",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="duration_in_months",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="title",
 *                              type="string"
 *                          ),
 *                     ),
 *                 ),
 *                 example={"page": "1", "limit": "3", "order_by": "id", "direction": "asc",
 *                      "search": {"id": "", "project": "", "code": "", "duration_in_months": "", "title": ""}
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
 *     path="/api/subscriptions/store",
 *     tags={"Subscriptions"},
 *     summary="Store subscription",
 *     security={{"api_key": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              @OA\Property(
 *               property="title",
 *               type="string"
 *              ),
 *              @OA\Property(
 *               property="gross_amount",
 *               type="double"
 *              ),
 *              @OA\Property(
 *               property="duration_in_months",
 *               type="int"
 *              ),
 *              @OA\Property(
 *               property="reward",
 *               type="float"
 *              ),
 *              @OA\Property(
 *               property="is_bonus_calc",
 *               type="boolean"
 *              ),
 *              @OA\Property(
 *               property="bw_code",
 *               type="string"
 *              ),
 *              @OA\Property(
 *               property="project_id",
 *               type="int"
 *              ),
 *              @OA\Property(
 *               property="starting_date",
 *               type="int"
 *              ),
 *               @OA\Property(
 *               property="availability_shift_id",
 *               type="int"
 *              ),
 *              example={"title": "Telegraaf", "duration_in_months": 5, "gross_amount": 20,
 *     "reward": 15.55, "is_bonus_calc": true,
 *                  "bw_code": "ABCD", "project_id": 1, "starting_date": "2020-01-01", "gross_amount": 120.00, "availability_shift_id": 1}
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
 *     path="/api/subscriptions/{id}/update",
 *     tags={"Subscriptions"},
 *     summary="Update subscription",
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
 *               property="title",
 *               type="string"
 *              ),
 *              @OA\Property(
 *               property="gross_amount",
 *               type="double"
 *              ),
 *              @OA\Property(
 *               property="duration_in_months",
 *               type="int"
 *              ),
 *              @OA\Property(
 *               property="reward",
 *               type="float"
 *              ),
 *              @OA\Property(
 *               property="is_bonus_calc",
 *               type="boolean"
 *              ),
 *              @OA\Property(
 *               property="bw_code",
 *               type="string"
 *              ),
 *              @OA\Property(
 *               property="project_id",
 *               type="int"
 *              ),
 *              @OA\Property(
 *               property="starting_date",
 *               type="int"
 *              ),
 *              example={"title": "Telegraaf","gross_amount": 120.00, "duration_in_months": 5, "reward": 15.55,
 *     "is_bonus_calc": true,
 *                  "bw_code": "ABCD", "project_id": 1, "starting_date": "2020-01-01"}
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
 *     path="/api/subscriptions/{id}/delete",
 *     tags={"Subscriptions"},
 *     summary="Delete subscription",
 *     security={{"api_key": {}}},
 *     @OA\Parameter(
 *          name="id",
 *          in="path"
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
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
 * @OA\GET(
 *     path="/api/subscriptions/{id}",
 *     tags={"Subscription"},
 *     summary="Get subscription by id",
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
