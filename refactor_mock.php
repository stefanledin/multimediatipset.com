<?php

/**
 * Alternativ
 */
# En match
$game->data = [
    'match' => 'Sverige - Belgien',
    'alternatives' => ['1', 'X', '2'],
    'worth' => 5,
    'correct' => 0
];
$prediction->data = [
    'match' => 'Sverige - Belgien',
    'answer' => '1'
];

$game->data = [
    'question' => 'Vinner Sverige mot Belgien?',
    'alternatives' => ['Ja', 'Nej'],
    'worth' => 5
];  
$prediction->data = [
    'answer' => 'Ja'
];

# Flera matcher
$game->data = [
    [
        'match' => 'Sverige - Belgien',
        'alternatives' => ['1', 'X', '2'],
        'worth' => 5,
        'correct' => 0
    ],
    [
        'match' => 'Italien - Irland',
        'alternatives' => ['1', 'X', '2'],
        'worth' => 1,
        'correct' => 0
    ]
];
$prediction->data = [
    [
        'match' => 'Sverige - Belgien',
        'answer' => 'X',
        'correct' => 0
    ],
    [
        'match' => 'Italien - Irland',
        'answer' => '2',
        'correct' => 0
    ]
];

/**
 * Score
 */
# En match
$game->data = [
    'match' => 'Sverige - Belgien',
    'worth' => 5
];
$prediction->data = [
    'match' => 'Sverige - Belgien',
    'answer' => '1-2',
    'correct' => 0
];
# Flera matcher
$game->data = [
    [
        'match' => 'Sverige - Belgien',
        'worth' => 5
    ],
    [
        'match' => 'Italien - Irland',
        'worth' => 1
    ],
];
$prediction->data = [
    [
        'match' => 'Sverige - Belgien',
        'answer' => '0-0',
        'correct' => 0
    ],
    [
        'match' => 'Italien - Irland',
        'answer' => '0-0',
        'correct' => 0
    ],
];

/**
 * Order
 */
# Sluttabell
$game->data = [
    'teams' => [
        'Färjestad', 'Frölunda', 'Skellefteå', 'Linköping', 'Växjö'
    ],
    'worth' => [
        'default' => 1,
        'teams' => [
            'Färjestad' => 10,
            'Skellefteå' => 5
        ],
        'positions' => [
            '1' => 20,
            '2' => 15,
            '3' => 10,
            '11' => 10,
            '12' => 10
        ]
    ]
];
$prediction->data = [
    'order' => [
        '1' => 'Färjestad',
        '2' => 'Skellefteå'
    ]
];