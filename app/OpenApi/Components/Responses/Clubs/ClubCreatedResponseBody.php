<?php

namespace App\OpenApi\Components\Responses\Clubs;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'ClubCreatedResponseBody',
    properties: [
        new Property(
            property: 'id',
            description: 'ID of the club',
            type: 'int',
            example: 1
        ),
        new Property(
            property: 'name',
            description: 'name of the club',
            type: 'string',
            format: 'name'
        ),
        new Property(
            property: 'country',
            description: 'club resident country',
            type: 'string',
        )
    ],
    type: 'object'
)]
class ClubCreatedResponseBody {}
