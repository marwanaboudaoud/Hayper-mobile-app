<?php

/**
 * @OA\POST(
 *     path="/api/contracts",
 *     tags={"Contracts"},
 *     summary="Search for contracts OR Get all ",
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
 *                              property="start_date",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="end_date",
 *                              type="string"
 *                          ),
 *                      @OA\Property(
 *                              property="employee_name",
 *                              type="string"
 *                          ),
 *                      @OA\Property(
 *                              property="contract_in_months",
 *                              type="string"
 *                          ),
 *                     ),
 *                 ),
 *                 example={"page": "1", "limit": "3", "order_by": "id", "direction": "asc",
 *                              "search": {"id": 1, "start_date": "", "end_date": "", "employee_name": "",
 *                         "contract_in_months": ""}
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
 *     path="/api/contracts/store",
 *     tags={"Contracts"},
 *     summary="Store contracts",
 *     security={{"api_key": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              @OA\Property(
 *               property="start_date",
 *               type="date"
 *              ),
 *              @OA\Property(
 *               property="end_date",
 *               type="date"
 *              ),
 *              @OA\Property(
 *               property="trial_per_day",
 *               type="date"
 *              ),
 *              @OA\Property(
 *               property="user",
 *               type="int"
 *              ),
 *
 *                 example={"start_date": "21-10-2020", "end_date": "21-10-2020", "trial_per_day": "2",
 *     "user": 1},
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
 *     path="/api/contracts/create-or-delete",
 *     tags={"Contracts"},
 *     summary="Delete contract or extend a contract",
 *     security={{"api_key": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              @OA\Property(
 *               property="is_extended",
 *               type="bool"
 *              ),
 *              @OA\Property(
 *               property="contract_id",
 *               type="int"
 *              ),
 *                 example={"is_extended": true, "contract_id": 1},
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
 *     path="/api/contracts/download-contract",
 *     tags={"Contracts"},
 *     summary="Download a contract",
 *     security={{"api_key": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              @OA\Property(
 *               property="contract_id",
 *               type="int"
 *              ),
 *                 example={"contract_id": 1},
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
