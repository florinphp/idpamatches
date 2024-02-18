<?php

namespace App\OpenApi\Components\Errors;

use OpenApi\Attributes\Examples;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'ServerError',
    properties: [
        new Property(
            property: 'message',
            description: 'generally description of the errors',
            type: 'string',
            example: 'The X field is required. (and 1 more error)'
        ),
        new Property(
            property: 'errors',
            description: 'array containing each field with error/s and descriptive messages for all the errors',
            type: 'object',
            ref: ValidationError::class
        )
    ],
    type: 'object'
)]
class UnprocessableContentError {}
