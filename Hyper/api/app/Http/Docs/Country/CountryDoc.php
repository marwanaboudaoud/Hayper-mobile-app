<?php

/**
 * Employee doc
 * @OA\GET(
 *     path="/api/countries",
 *     tags={"Countries"},
 *     summary="Get all countries",
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
