<?php
/**
 * Employee doc
 * @OA\GET(
 *     path="/api/genders",
 *     tags={"Genders"},
 *     summary="Get all genders",
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
