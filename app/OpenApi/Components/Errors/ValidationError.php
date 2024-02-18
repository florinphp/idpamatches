<?php

namespace App\OpenApi\Components\Errors;

use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'ValidationError',
    properties: [
        new Property(
            property: 'field_name',
            description: 'general description of the errors for the field',
            type: 'array',
            items: new Items(
                description: 'array of errors',
                example: "The field_name is required.",
            )
        ),
    ],
    type: 'object'
)]
class ValidationError {}
