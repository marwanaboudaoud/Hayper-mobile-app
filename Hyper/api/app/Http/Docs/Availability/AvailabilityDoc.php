<?php

/**
 * Availability store
 * @OA\POST(
 *     path="/api/availabilities/store",
 *     tags={"Availabilities"},
 *     summary="Store availability",
 *     security={{"api_key": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              @OA\Property(
 *               property="date",
 *               type="date"
 *              ),
 *              @OA\Property(
 *               property="is_present",
 *               type="boolean"
 *              ),
 *              @OA\Property(
 *               property="availability_shift_id",
 *               type="int"
 *              ),
 *              example={"date": "2020-01-01", "is_present": true,
 *              "availability_shift_id": 1}
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
 *     path="/api/availabilities/{id}/update",
 *     tags={"Availabilities"},
 *     summary="Update availability",
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
 *               property="date",
 *               type="date"
 *              ),
 *              @OA\Property(
 *               property="is_present",
 *               type="boolean"
 *              ),
 *              @OA\Property(
 *               property="availability_shift_id",
 *               type="int"
 *              ),
 *              example={"date": "2020-01-01", "is_present": true, "availability_shift_id": 1}
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
