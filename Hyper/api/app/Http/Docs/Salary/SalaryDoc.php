<?php

/**
 * @OA\POST(
 *     path="/api/salaries",
 *     tags={"Salaries"},
 *     summary="Get salaries",
 *     security={{"api_key": {}}},
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(
 *                     property="page",
 *                     type="int"
 *                 ),
 *              @OA\Property(
 *                     property="limit",
 *                     type="int"
 *                 ),
 *              @OA\Property(
 *                     property="order_by",
 *                     type="string"
 *                 ),
 *              @OA\Property(
 *                     property="direction",
 *                     type="string"
 *                 ),
 *              @OA\Property(
 *                     property="salary",
 *                     type="array",
 *                     @OA\Items(
 *                      @OA\Property(
 *                          property="id",
 *                          type="int"
 *                      ),
 *                      @OA\Property(
 *                          property="employee_name",
 *                          type="string"
 *                     ),
 *                     @OA\Property(
 *                          property="date",
 *                         type="string"
 *                      ),
 *                     @OA\Property(
 *                          property="heading",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="description",
 *                          type="string"
 *                      ),
 *                      @OA\Property(
 *                          property="price",
 *                          type="float"
 *                      ),
 *                 ),
 *              @OA\Property(
 *                     property="filter",
 *                     type="array",
 *                     @OA\Items(
 *                      @OA\Property(
 *                          property="month",
 *                          type="int"
 *                      ),
 *                      @OA\Property(
 *                          property="year",
 *                          type="int"
 *                     )
 *                      ),
 *                 ),
 *             ),
 *             example={"page": "1", "limit": "3", "order_by": "id", "direction": "asc",
 *                  "salary": {"employee_name": "", "date": "", "heading": "", "description": "", "price": ""},
 *                  "filter": {"month": 1,"year": 1973}
 *                  }
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Salary not found!"
 *     ),
 * )
 */

/**
 * @OA\GET(
 *     path="/api/salaries/{id}",
 *     tags={"Salaries"},
 *     summary="Find salary",
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
 *         response="404",
 *         description="Salary not found!"
 *     ),
 *     @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */
