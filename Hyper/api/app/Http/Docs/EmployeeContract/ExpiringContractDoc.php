<?php

/**
 * @OA\POST(
 *     path="/api/expiring-contracts",
 *     tags={"Contracts"},
 *     summary="All Expiring contracts",
 *     security={{"api_key": {}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *              @OA\Property(
 *               property="order_by",
 *               type="string"
 *              ),
 *              @OA\Property(
 *               property="direction",
 *               type="asc"
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
 *                 example={"order_by": "employee_name", "direction": "asc"}
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
