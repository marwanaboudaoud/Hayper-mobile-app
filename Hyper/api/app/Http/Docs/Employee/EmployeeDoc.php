<?php

/**
 * Employee doc
 * @OA\POST(
 *     path="/api/employees",
 *     tags={"Employees"},
 *     summary="Search for employee OR Get all ",
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
 *                     type="array",
 * @OA\Items(
 * @OA\Property(
 *                     property="alias",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="initials",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="first_name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="insertion",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="gender_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="last_name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="phone",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="has_drivers_license",
 *                     type="bool"
 *                 ),
 * @OA\Property(
 *                     property="date_of_birth",
 *                     type="date"
 *                 ),
 * @OA\Property(
 *                     property="country_of_birth",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="nationality_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="marital_status_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="bsn",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="iban",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="income_tax",
 *                     type="bool"
 *                 ),
 * @OA\Property(
 *                     property="role_id",
 *                     type="int"
 *                 ),
 *                     ),
 *                 ),
 *                 example={"page": "1", "limit": "3", "order_by": "id or related table using table . columnname", "direction": "asc",
 *                "search": {"alias": "Rickert", "initials": "rvw", "first_name": "holy", "insertion": "G",
 *                 "last_name": "Row", "gender_id": 1, "email": "info@holygrow.nl", "phone": "0612345678",
 *                 "has_drivers_license": true, "date_of_birth": "2019-01-01", "country_of_birth_id": 1,
 *                 "nationality_id": 1, "marital_status_id": 1, "bsn": 2028382949, "iban": "NL62 ATTA 12634654562",
 *                  "income_tax": true, "role_id": 1, },
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
 *     path="/api/employees/store",
 *     tags={"Employees"},
 *     summary="Create one employee",
 *     security={{"api_key": {}}},
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
 * @OA\Property(
 *                     property="alias",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="initials",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="first_name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="insertion",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="gender_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="last_name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="phone",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="has_drivers_license",
 *                     type="bool"
 *                 ),
 * @OA\Property(
 *                     property="date_of_birth",
 *                     type="date"
 *                 ),
 * @OA\Property(
 *                     property="country_of_birth",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="nationality_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="marital_status_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="bsn",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="iban",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="income_tax",
 *                     type="bool"
 *                 ),
 * @OA\Property(
 *                     property="role_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="works_on_project",
 *                     type="array",
 * @OA\Items(
 *
 *                     )
 *                 ),
 * @OA\Property(
 *                     property="address",
 *                     type="object",
 * @OA\Property(
 *                              property="street",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="house_number",
 *                              type="int"
 *                          ),
 * @OA\Property(
 *                              property="postcode",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="city",
 *                              type="string"
 *                          ),
 *                 ),
 * @OA\Property(
 *                     property="emergency_contact",
 *                     type="object",
 * @OA\Property(
 *                              property="first_name",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="last_name",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="phone",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="relationship",
 *                              type="string"
 *                          ),
 *                 ),
 * @OA\Property(
 *                     property="contract",
 *                     type="object",
 * @OA\Property(
 *                              property="start_date",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="end_date",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="trial_per_day",
 *                              type="int"
 *                          ),
 * @OA\Property(
 *                              property="document_number",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="expiration_date",
 *                              type="int"
 *                          ),
 *                 ),
 *                 example={"alias": "Rickert", "initials": "rvw", "first_name": "holy", "insertion": "G",
 *                 "last_name": "Row", "gender_id": 1, "email": "info@holygrow.nl", "phone": "0612345678",
 *                 "has_drivers_license": true, "date_of_birth": "2019-01-01", "country_of_birth_id": 1,
 *                 "nationality_id": 1, "marital_status_id": 1, "bsn": 2028382949, "iban": "NL62 ATTA 12634654562",
 *                  "income_tax": true, "role_id": 1,
 *                 "address": {
 *                  "street": "Kruisplein", "house_number": 100, "postcode": "3016PA", "city": "Rotterdam"
 *                 },
 *                 "emergency_contact": {
 *                  "first_name": "Holy", "last_name": "Ho", "phone": "0612345678", "relationship": "Bedrijf"
 *                 },
 *                 "contract": {
 *                  "start_date": "2020-02-19", "end_date": "2020-10-20", "trial_per_day": 20,
 *                  "document_number": "2qsdf3vgd", "expiration_date": "2020-12-20"
 *                 }
 *     }
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *         response="409",
 *         description="Email allready exists!"
 *     ),
 * @OA\Response(
 *         response="422",
 *         description="Token not set! Or data not valid!"
 *     ),
 *
 * )
 */

/**
 * @OA\POST(
 *     path="/api/employees/activate",
 *     tags={"Employees"},
 *     summary="Activate employee",
 *     description="Activate user when employee is created.",
 * @OA\RequestBody(
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
 *          response=409,
 *          description="Activate token already used!"
 *      ),
 * @OA\Response(
 *          response=500,
 *          description="Something went wrong!"
 *      ),
 * )
 */

/**
 * @OA\GET(
 *     path="/api/employees/{id}",
 *     tags={"Employees"},
 *     summary="Get all employees",
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

/**
 * @OA\POST(
 *     path="/api/employees/{id}/update",
 *     tags={"Employees"},
 *     summary="Update employee",
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
 *                     property="alias",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="initials",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="first_name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="insertion",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="last_name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="phone",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="has_drivers_license",
 *                     type="bool"
 *                 ),
 * @OA\Property(
 *                     property="date_of_birth",
 *                     type="date"
 *                 ),
 * @OA\Property(
 *                     property="country_of_birth",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="nationality_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="marital_status_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="bsn",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="iban",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="role_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="gender_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="address",
 *                     type="object",
 * @OA\Property(
 *                              property="id",
 *                              type="int"
 *                          ),
 * @OA\Property(
 *                              property="street",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="house_number",
 *                              type="int"
 *                          ),
 * @OA\Property(
 *                              property="postcode",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="city",
 *                              type="string"
 *                          ),
 *                 ),
 * @OA\Property(
 *                     property="emergency_contact",
 *                     type="object",
 * @OA\Property(
 *                              property="id",
 *                              type="int"
 *                          ),
 * @OA\Property(
 *                              property="first_name",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="last_name",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="phone",
 *                              type="string"
 *                          ),
 * @OA\Property(
 *                              property="relationship",
 *                              type="string"
 *                          ),
 *                 ),
 *
 *                 example={"alias": "Rickert", "initials": "rvw", "first_name": "holy", "insertion": "G",
 *                 "last_name": "Row", "email": "info@holygrow.nl", "phone": "0612345678",
 *                 "has_drivers_license": true, "date_of_birth": "2019-01-01", "country_of_birth_id": 1,
 *                 "nationality_id": 1, "marital_status_id": 1, "iban": "NL62 ATTA 12634654562",
 *                  "income_tax": true, "role_id": 1, "gender_id": 1,
 *                 "address": {
 *                   "id": 1, "street": "Kruisplein", "house_number": 100, "postcode": "3016PA", "city": "Rotterdam"
 *                 },
 *                 "emergency_contact": {
 *                      "id": 1, "first_name": "Holy", "last_name": "Ho", "phone": "0612345678",
 *                      "relationship": "Bedrijf"
 *                 }
 *     }
 *             )
 *         )
 *     ),
 * @OA\Response(
 *         response="200",
 *         description="Successful operation!"
 *     ),
 * @OA\Response(
 *         response="409",
 *         description="Email allready exists!"
 *     ),
 * @OA\Response(
 *         response="422",
 *         description="Token not set! Or data not valid!"
 *     ),
 *
 * )
 */

/**
 * @OA\POST(
 *     path="/api/employees/export-generate",
 *     tags={"Employees"},
 *     summary="Generate csv export",
 *     security={{"api_key": {}}},
 * @OA\RequestBody(
 * @OA\MediaType(
 *             mediaType="application/json",
 * @OA\Schema(
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
 *                     type="array",
 * @OA\Items(
 * @OA\Property(
 *                     property="alias",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="initials",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="first_name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="insertion",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="gender_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="last_name",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="phone",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="has_drivers_license",
 *                     type="bool"
 *                 ),
 * @OA\Property(
 *                     property="date_of_birth",
 *                     type="date"
 *                 ),
 * @OA\Property(
 *                     property="country_of_birth",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="nationality_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="marital_status_id",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="bsn",
 *                     type="int"
 *                 ),
 * @OA\Property(
 *                     property="iban",
 *                     type="string"
 *                 ),
 * @OA\Property(
 *                     property="income_tax",
 *                     type="bool"
 *                 ),
 * @OA\Property(
 *                     property="role_title",
 *                     type="string"
 *                 ),
 *                     ),
 *                 ),
 *                 example={"order_by": "id", "direction": "asc",
 *                "search": {"alias": "Rickert", "initials": "rvw", "first_name": "holy", "insertion": "G",
 *                 "last_name": "Row", "gender_id": 1, "email": "info@holygrow.nl", "phone": "0612345678",
 *                 "has_drivers_license": true, "date_of_birth": "2019-01-01", "country_of_birth_id": 1,
 *                 "nationality_id": 1, "marital_status_id": 1, "bsn": 2028382949, "iban": "NL62 ATTA 12634654562",
 *                  "income_tax": true, "role_title": "Admin", },
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
