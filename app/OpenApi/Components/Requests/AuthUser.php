<?php

namespace App\OpenApi\Components\Requests;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'AuthUser',
    properties: [
        new Property(
            property: 'email',
            description: 'email address used for login',
            type: 'string',
            format: 'email'
        ),
        new Property(
            property: 'password',
            description: 'password for the email used',
            type: 'string',
        )
    ],
    type: 'object'
)]
class AuthUser {}
