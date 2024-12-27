<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="Comment",
 *     type="object",
 *     title="Comment",
 *     description="Comment schema",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The unique identifier of the comment"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="The email of the comment author"
 *     ),
 *     @OA\Property(
 *         property="body",
 *         type="string",
 *         description="The body of the comment"
 *     )
 * )
 */
class Comment
{
    // This class is just a placeholder for the Swagger annotations
}