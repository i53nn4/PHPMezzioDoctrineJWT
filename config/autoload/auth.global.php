<?php

return [
    'auth' => [
        'jwt' => [
            'claim' => [
                'iss' => 'https:localdomain.dev',
                'aud' => 'https:localdomain.dev',
            ],
            // A DateTime interval dictating how long the token should be valid for
            'expiryPeriod' => 'P10D',
            'leeway' => 60,
            'allowedAlgorithms' => [
                'HS256'
            ]
        ]
    ]
];
