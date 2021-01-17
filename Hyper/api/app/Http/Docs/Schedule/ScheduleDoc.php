<?php

/**
 * @OA\POST(
 *     path="/api/schedules",
 *     tags={"Schedules"},
 *     summary="Get all schedules per week",
 *     security={{"api_key": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="week",
 *                     type="int"
 *                 ),
 *                 @OA\Property(
 *                     property="year",
 *                     type="int"
 *                 ),
 *                 example={"week": "1", "year": "2020"}
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
 *     path="/api/schedules/store",
 *     tags={"Schedules"},
 *     summary="Store schedules",
 *     security={{"api_key": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="items",
 *                     type="array",
 *                     @OA\Items(
 *                          @OA\Property(
 *                              property="name",
 *                              type="string"
 *                          ),
 *                          @OA\Property(
 *                              property="address",
 *                              type="string"
 *                          ),
 *                          @OA\Property(
 *                              property="postcode",
 *                              type="string"
 *                          ),
 *                          @OA\Property(
 *                              property="city",
 *                              type="string"
 *                          ),
 *                          @OA\Property(
 *                              property="date",
 *                              type="date"
 *                          ),
 *                          @OA\Property(
 *                              property="driver",
 *                              type="int"
 *                          ),
 *                          @OA\Property(
 *                              property="project_id",
 *                              type="int"
 *                          ),
 *                          @OA\Property(
 *                              property="availability_shift_id",
 *                              type="int"
 *                          ),
 *                          @OA\Property(
 *                              property="employees",
 *                              type="array",
 *                              @OA\Items(type="int"),
 *                          ),
 *                     ),
 *                 ),
 *                 example={"items": {{"name": "Mrs. Novella Runolfsson", "address": "Test address",
 *     "postcode": "1628VJ", "city": "Rotterdam", "date": "2019-01-01", "driver": 1, "availability_shift_id": 1,
 *     "project_id": 1,
 *     "employees": {1,2,3}}}}
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
 *     path="/api/schedules/{id}/update",
 *     tags={"Schedules"},
 *     summary="Store schedules",
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
 *               property="address",
 *               type="string"
 *              ),
 *              @OA\Property(
 *               property="postcode",
 *               type="string"
 *              ),
 *              @OA\Property(
 *               property="city",
 *               type="string"
 *              ),
 *              @OA\Property(
 *               property="date",
 *               type="date"
 *              ),
 *              @OA\Property(
 *               property="driver",
 *               type="int"
 *              ),
 *              @OA\Property(
 *               property="project_id",
 *               type="int"
 *              ),
 *              @OA\Property(
 *               property="availability_shift_id",
 *               type="int"
 *              ),
 *              @OA\Property(
 *               property="employees",
 *               type="array",
 *               @OA\Items(type="int"),
 *              ),
 *
 *                 example={"name": "Mrs. Novella Runolfsson", "address": "Test address", "postcode": "1628VJ",
 *     "city": "Rotterdam", "date": "2019-01-01", "driver": 1, "availability_shift_id": 1,
 *     "project_id": 1, "employees": {1, 2, 3}},
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
 *     path="/api/schedules/{id}/delete",
 *     tags={"Schedules"},
 *     summary="Delete schedule",
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
