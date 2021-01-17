<?php

/**
 * @OA\POST(
 *     path="/api/salaries-manual/{salary_id}/store",
 *     tags={"Salaries"},
 *     summary="Store manual salary",
 *     security={{"api_key": {}}},
 *     @OA\Parameter(
 *          name="salary_id",
 *          in="path"
 *     ),
 *     @OA\RequestBody(
 *      @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(
 *                     property="date",
 *                     type="date"
 *              ),
 *              @OA\Property(
 *                     property="description",
 *                     type="string"
 *              ),
 *              @OA\Property(
 *                     property="price",
 *                     type="float"
 *              ),
 *              example={"date": "2020-01-01", "description": "Lorem ipsum", "price": "1.99"}
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
 * @OA\POST(
 *     path="/api/salaries-manual/{salary_day_id}/delete",
 *     tags={"Salaries"},
 *     summary="Delete manual added salary row",
 *     security={{"api_key": {}}},
 * @OA\Parameter(
 *          name="salary_day_id",
 *          in="path"
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *         response="400",
 *         description="Salary row not found"
 *     ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */
