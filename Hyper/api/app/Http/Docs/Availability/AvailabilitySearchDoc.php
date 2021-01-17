<?php

/**
 * Availability Search doc
 * @OA\POST(
 *     path="/api/availabilities/search",
 *     tags={"Availabilities"},
 *     summary="Search availability",
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
 *               property="is_driver",
 *               type="bool"
 *              ),
 *              example={"date": "2019-01-01", "is_driver": false}
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
 * @param AvailabilitySearchRequest $searchRequest
 * @return JsonResponse
 */
