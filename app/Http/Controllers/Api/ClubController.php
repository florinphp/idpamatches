<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClubRequest;
use App\Http\Resources\ClubResource;
use App\Models\Club;
use App\OpenApi\Components\Errors\ServerError;
use App\OpenApi\Components\Errors\UnprocessableContentError;
use App\OpenApi\Components\Requests\ClubCreateRequestBody;
use App\OpenApi\Components\Responses\AuthUserSuccess;
use App\OpenApi\Components\Responses\Clubs\ClubCreatedResponseBody;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes\Delete;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Put;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\SecurityScheme;

class ClubController extends Controller
{
    #[Get(
        path: '/clubs',
        operationId: 'listAllClubs',
        security: [
            new SecurityScheme(
                securityScheme: 'bearerAuth',
                type: 'apiKey'
            )
        ],
        tags: ['clubs'],
        responses: [
            new Response(
                response: 200,
                description: 'OK',
                content: new JsonContent(
                    ref: AuthUserSuccess::class,
                    type: 'object'
                )
            ),
            new Response(
                response: 422,
                description: 'Unprocessable Content',
                content: new JsonContent(
                    ref: UnprocessableContentError::class,
                    type: 'object'
                )
            ),
            new Response(
                response: 500,
                description: 'Server Error',
                content: new JsonContent(
                    ref: ServerError::class,
                    type: 'object'
                )
            ),
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        return response()->json(ClubResource::collection(Club::all()));
    }

    #[Post(
        path: '/clubs',
        operationId: 'createClub',
        requestBody: new RequestBody(
            description: 'new club payload',
            content: [
                new MediaType(
                    mediaType: 'application/json',
                    schema: new Schema(
                        ref: ClubCreateRequestBody::class
                    )
                )
            ]
        ),
        tags: ['clubs'],
        responses: [
            new Response(
                response: 200,
                description: 'OK',
                content: new JsonContent(
                    ref: ClubCreatedResponseBody::class,
                    type: 'object'
                )
            ),
            new Response(
                response: 422,
                description: 'Unprocessable Content',
                content: new JsonContent(
                    ref: UnprocessableContentError::class,
                    type: 'object'
                )
            ),
        ]
    )]
    public function store(StoreClubRequest $request): JsonResponse
    {
        return response()->json(new ClubResource(Club::create($request->only(['name', 'country']))));
    }

    #[Get(
        path: '/clubs/{id}',
        operationId: 'viewClub',
        requestBody: new RequestBody(
            description: 'view club',
        ),
        tags: ['clubs'],
        responses: [
            new Response(
                response: 200,
                description: 'OK',
                content: new JsonContent(
                    ref: ClubCreatedResponseBody::class,
                    type: 'object'
                )
            ),
            new Response(
                response: 404,
                description: 'Not Found',
            ),
        ]
    )]
    public function show(Request $request, int $id): JsonResponse
    {
        if (($club = Club::find($id)) instanceof Club) {
            return response()->json(new ClubResource($club));
        } else {
            return response()->json([], 404);
        }
    }

    #[Put(
        path: '/clubs/{id}',
        operationId: 'updateClub',
        requestBody: new RequestBody(
            description: 'update club payload',
            content: [
                new MediaType(
                    mediaType: 'application/json',
                    schema: new Schema(
                        ref: ClubCreateRequestBody::class
                    )
                )
            ]
        ),
        tags: ['clubs'],
        responses: [
            new Response(
                response: 200,
                description: 'OK',
                content: new JsonContent(
                    ref: ClubCreatedResponseBody::class,
                    type: 'object'
                )
            ),
            new Response(
                response: 404,
                description: 'Not Found',
            ),
            new Response(
                response: 422,
                description: 'Unprocessable Content',
                content: new JsonContent(
                    ref: UnprocessableContentError::class,
                    type: 'object'
                )
            ),
        ]
    )]
    public function update(StoreClubRequest $request, int $id): JsonResponse
    {
        $club = Club::find($id);
        $club->update($request->only(['name', 'country']));

        return response()->json(new ClubResource($club));
    }

    #[Delete(
        path: '/clubs/{id}',
        operationId: 'deleteClub',
        tags: ['clubs'],
        responses: [
            new Response(
                response: 200,
                description: 'OK',
            ),
            new Response(
                response: 404,
                description: 'Not Found',
            ),
        ]
    )]
    public function delete(Request $request, int $id): JsonResponse
    {
        return response()->json(Club::find($id)->delete());
    }
}
