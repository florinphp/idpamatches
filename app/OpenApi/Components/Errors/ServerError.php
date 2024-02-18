<?php

namespace App\OpenApi\Components\Errors;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'UnprocessableContentError',
    properties: [
        new Property(
            property: 'status',
            description: 'status of the request',
            type: 'boolean',
            example: false
        ),
        new Property(
            property: 'message',
            description: 'descriptive message for the current server error',
            type: 'string',
            example: 'Could not execute the action due to server error'
        )
    ],
    type: 'object'
)]
class ServerError {}
