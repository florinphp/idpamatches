<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Info;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\SecurityScheme;

#[Info(
    version: '1.0.0',
    title: 'IDPA Matches'
)]
#[SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    name: 'bearerAuth',
    in: 'header',
    bearerFormat: 'JWT',
    scheme: 'bearer'
)]

class ApiDocsController extends Controller
{
    /**
     * API doc title
     *
     * @OA\Property
     */
    public string $title;

    #[Get(
        path: '/api-docs',
        operationId: 'getApiDocs',
        tags: ['api-docs'],
        responses: [
            new Response(response: 200, description: 'OK'),
            new Response(response: 401, description: 'Not Allowed'),
        ]
    )]
    public function view(): Factory|View
    {
        return view('api-docs/index');
    }
}
