<?php
namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="Post",
 *     type="object",
 *     title="Post",
 *     description="Post Schema",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="Sample Post Title"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         example="This is a sample description for the post."
 *     ),
 *     @OA\Property(
 *         property="publish_date",
 *         type="string",
 *         format="date-time",
 *         example="2023-10-01T12:00:00Z"
 *     ),
 *     @OA\Property(
 *         property="author",
 *         ref="#/components/schemas/User"
 *     ),
 *     @OA\Property(
 *         property="comments_no",
 *         type="integer",
 *         example=5
 *     ),
 *     @OA\Property(
 *         property="comments",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Comment")
 *     )
 * )
 */
class Post
{
}