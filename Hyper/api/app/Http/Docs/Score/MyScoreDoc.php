<?php

/**
 * @OA\POST(
 *     path="/api/my-score",
 *     tags={"Score"},
 *     summary="Get my scores",
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
