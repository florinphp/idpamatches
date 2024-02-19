<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\OpenApi\Components\Errors\ServerError;
use App\OpenApi\Components\Errors\UnprocessableContentError;
use App\OpenApi\Components\Requests\AuthUser;
use App\OpenApi\Components\Responses\AuthUserSuccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;

class AuthController extends Controller
{
    #[Post(
        path: '/auth/register',
        operationId: 'registerUser',
        requestBody: new RequestBody(
            description: 'new user register payload',
            content: [
                new MediaType(
                    mediaType: 'application/json',
                    schema: new Schema(
                        ref: AuthUser::class
                    )
                )
            ]
        ),
        tags: ['auth'],
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
    public function register(RegisterUserRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Could not register a new user'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'token' => $user->createToken("API_TOKEN")->plainTextToken
        ], 200);
    }

    #[Post(
        path: '/auth/login',
        operationId: 'loginUser',
        requestBody: new RequestBody(
            description: 'user login payload',
            content: [
                new MediaType(
                    mediaType: 'application/json',
                    schema: new Schema(
                        ref: AuthUser::class
                    )
                )
            ]
        ),
        tags: ['auth'],
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
            )
        ]
    )]
    public function login(LoginUserRequest $request): JsonResponse
    {
        try {
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Email or Password.',
                ], 401);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'message' => 'Logged in successfully',
            'token' => $user->createToken("API_TOKEN")->plainTextToken
        ], 200);
    }
}
