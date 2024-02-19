<?php

namespace App\OpenApi\Components\Requests;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(
    schema: 'ClubCreateRequestBody',
    properties: [
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
class ClubCreateRequestBody {}
