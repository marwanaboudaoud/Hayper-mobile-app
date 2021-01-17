<?php
/**
 * Employee doc
 * @OA\GET(
 *     path="/api/nationalities",
 *     tags={"Nationlities"},
 *     summary="Get all nationalities",
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
