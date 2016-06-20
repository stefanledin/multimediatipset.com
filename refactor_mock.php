<?php

# Alternativ
# En match
$game->data = [
    'match' => 'Sverige - Belgien',
    'alternatives' => ['1', 'X', '2'],
    'worth' => 5,
    'correct' => 0
];
$game->data = [
    'question' => 'Vinner Sverige mot Belgien?',
    'alternatives' => ['Ja', 'Nej'],
    'worth' => 5
];  
# Alternativ
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

# Score
# En match
$game->data = [
    'match' => 'Sverige - Belgien',
    'worth' => 5
];
# Score
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

# Order
# Sluttabell
$game->data = [
    'teams' => [
        'Färjestad', 'Frölunda', 'Skellefteå', 'Linköping', 'Växjö'
    ],
    'worth' => [
        'default' => 1,
        '1' => 20,
        '2' => 15,
        '3' => 10,
        '11' => 10,
        '12' => 10
    ]
];