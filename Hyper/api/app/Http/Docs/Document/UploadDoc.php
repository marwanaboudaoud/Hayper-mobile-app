<?php

/**
 * @OA\POST(
 *     path="/api/uploads/store",
 *     tags={"Uploads"},
 *     summary="Store document",
 *     security={{"api_key": {}}},
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="document_name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="body",
 *                     type="file"
 *                 ),
 * @OA\Property(
 *                     property="document_type",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="user_id",
 *                     type="int"
 *                 ),
 *                 example={"document_name": "name of document", "body": "", "document_type": "te kiezen uit: CV,
     *                      Contract, Identiteitskaart", "user_id": 1}
     *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *          response=404,
 *          description="Employee not found"
 *      ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */
