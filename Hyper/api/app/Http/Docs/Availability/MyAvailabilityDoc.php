<?php

/**
 * @OA\POST(
 *     path="/api/my-availability",
 *     tags={"Availabilities"},
 *     summary="Employee availability",
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
 *              example={"start_date": "2020-01-01", "end_date": "2020-01-01"}
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
