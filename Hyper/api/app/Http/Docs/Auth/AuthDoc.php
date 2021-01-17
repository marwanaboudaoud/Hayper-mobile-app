<?php

use OpenApi\Annotations as OA;

/**
 * Login Doc
 * @OA\POST(
 *     path="/api/login",
 *     tags={"Authentication"},
 *     summary="Returns a JWT token",
 *     description="Login api",
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="password",
 *                     type="password"
 *                 ),
 *                 example={"email": "info@holygrow.nl", "password": "123456"}
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *          response=404,
 *          description="User not found!"
 *      ),
 * @OA\Response(
 *          response=403,
 *          description="User not active!"
 *      ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */

/**
 * Forgot password doc
 * @OA\POST(
 *     path="/api/forgot-password",
 *     tags={"Authentication"},
 *     summary="Send a request for forgot password",
 *     description="Reset password",
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 *                 example={"email": "info@holygrow.nl"}
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *          response=404,
 *          description="User not found!"
 *      ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */

/**
 * Reset password doc
 * @OA\POST(
 *     path="/api/reset-password",
 *     tags={"Authentication"},
 *     summary="Send a request for resetting a password",
 *     description="Reset password",
 * @OA\RequestBody(
 *
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="password",
 *                     type="password"
 *                 ),
 * @OA\Property(
 *                     property="password_confirmation",
 *                     type="password"
 *                 ),
 * @OA\Property(
 *                     property="token",
 *                     type="string"
 *                 ),
 *                 example={"password": "123456", "password_confirmation": "123456", "token": "abc"}
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="204",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *          response=404,
 *          description="Reset token not found!"
 *      ),
 * @OA\Response(
 *          response=409,
 *          description="Token already used!"
 *      ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */
