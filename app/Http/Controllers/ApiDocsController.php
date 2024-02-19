<?php

namespace App\Http\Controllers;

use http\Env;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Info;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\SecurityScheme;
use OpenApi\Attributes\Server;

#[Info(
    version: '1.0.0',
    title: 'IDPA Matches'
)]
#[Server(
    url: 'http://idpamatches.test/api/v1'
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
