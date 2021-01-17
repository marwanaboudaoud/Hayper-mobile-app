<?php

/**
 * @OA\POST(
 *     path="/api/my-schedule",
 *     tags={"Schedules"},
 *     summary="Get my schedule",
 *     security={{"api_key": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="start_date",
 *                     type="date"
 *                 ),
 *                 @OA\Property(
 *                     property="end_date",
 *                     type="date"
 *                 ),
 *                 example={"start_date": "Y-m-d","end_date": "Y-m-d"}
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
