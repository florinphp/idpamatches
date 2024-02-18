<?php

namespace App\OpenApi\Components\Responses;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'AuthUserSuccess',
    properties: [
        new Property(
            property: 'status',
            description: 'status of the request',
            type: 'boolean',
            example: true
        ),
        new Property(
            property: 'message',
            description: 'details on the success of the request',
            type: 'string',
            example: 'User created/logged in successfully'
        ),
        new Property(
            property: 'token',
            description: 'JWToken string',
            type: 'string',
            example: '1|HTOtsWaO83EiII2upONaGQBJxDsDycEQQhlN5KjNf1631f8f',
        )
    ],
    type: 'object'
)]
class AuthUserSuccess {}
