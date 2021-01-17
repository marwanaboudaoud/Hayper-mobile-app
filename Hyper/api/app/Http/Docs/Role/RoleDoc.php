<?php

/**
 * @OA\POST(
 *     path="/api/roles",
 *     tags={"Roles"},
 *     summary="Search for roles OR Get all ",
 *     security={{"api_key": {}}},
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="page",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="limit",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="order_by",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="direction",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="search",
 *                     type="object",
 * @OA\Items(
 * @OA\Property(
 *                              property="id",
 *                              type="int"
 *                          ),
 * @OA\Property(
 *                              property="title",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="code_in_nmbrs",
 *                              type="int"
 *                          ),
 *                     ),
 *                 ),
 *                 example={"page": "1", "limit": "3", "order_by": "id", "direction": "asc",
 *                              "search": {"id": 1, "title": "", "code_in_nmbrs": 100}
 *                  }
 *             )
 *         )
 *     ),
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

/**
 * @OA\POST(
 *     path="/api/roles/store",
 *     tags={"Roles"},
 *     summary="Store role",
 *     security={{"api_key": {}}},
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="title",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="code_in_nmbrs",
 *                     type="int"
 *                 ),
 *                 example={"title": "", "code_in_nmbrs": 100}
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *          response=409,
 *          description="Role already exists"
 *      ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */

/**
 * @OA\POST(
 *     path="/api/roles/{id}/update",
 *     tags={"Roles"},
 *     summary="Store role",
 *     security={{"api_key": {}}},
 * @OA\Parameter(
 *          name="id",
 *          in="path"
 *     ),
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="title",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="code_in_nmbrs",
 *                     type="int"
 *                 ),
 *                 example={"title": "", "code_in_nmbrs": 100}
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *          response=409,
 *          description="Role already exists"
 *      ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */

/**
 * @OA\POST(
 *     path="/api/roles/{id}/delete",
 *     tags={"Roles"},
 *     summary="Archive a role",
 *     security={{"api_key": {}}},
 * @OA\Parameter(
 *          name="id",
 *          in="path"
 *     ),
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *          response=409,
 *          description="Role is currently in use"
 *      ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */

/**
 * @OA\GET(
 *     path="/api/roles/{id}",
 *     tags={"Role"},
 *     summary="Get roles by id",
 *     security={{"api_key": {}}},
 * @OA\Parameter(
 *          name="id",
 *          in="path"
 *     ),
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
