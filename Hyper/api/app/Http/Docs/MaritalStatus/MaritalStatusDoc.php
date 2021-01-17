<?php
/**
 * Employee doc
 * @OA\GET(
 *     path="/api/maritalstatuses",
 *     tags={"Marital Statuses"},
 *     summary="Get all marital statuses",
 *     security={{"api_key": {}}},
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
