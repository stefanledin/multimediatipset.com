<?php
// Tabeller
// 
// Game (name, type, cost, in_pot, winners, levels?)
// Question (title, worth, answer, alternatives)
// Answer (answer, is_correct)


/**
 * Alternativ
 */
# En match
Game::create([
    'name' => 'Sverige - Belgien',
    'type' => 'Alternatives'
]);
Question::create([
    'title' => 'Resultat',
    'alternatives' => ['1', 'X', '2'],
    'worth' => 5,
    'answer' => 0,
    'game_id' => 1,
]);
Answer::create([
    'question_id' => 1,
    'answer' => '1',
    'is_correct' => false
]);

Question::create([
    'title' => 'Vinner Sverige mot Belgien?',
    'alternatives' => ['1', 'X', '2'],
    'worth' => 5,
    'answer' => 0,
    'game_id' => 1,
]);
Answer::create([
    'question_id' => 2,
    'answer' => 'Ja',
    'is_correct' => false
]);

# Flera matcher
Question::create([
    'title' => 'Sverige - Belgien',
    'alternatives' => ['1', 'X', '2'],
    'worth' => 5,
    'answer' => 0,
    'game_id' => 1,
]);
Question::create([
    'title' => 'Italien - Irland',
    'alternatives' => ['1', 'X', '2'],
    'worth' => 1,
    'answer' => 0,
    'game_id' => 1,
]);
Answer::create([
    'question_id' => 2,
    'answer' => '2',
    'is_correct' => false
]);
Answer::create([
    'question_id' => 3,
    'answer' => '1',
    'is_correct' => false
]);

/**
 * Score
 */
# En match
Game::create([
    'name' => 'Sverige - Belgien',
    'type' => 'Score'
]);
Question::create([
    'title' => 'Resultat',
    'worth' => 5,
    'answer' => 0,
    'game_id' => 1,
]);
Answer::create([
    'question_id' => 1,
    'answer' => '1-2',
    'is_correct' => false
]);

/**
 * Order
 */
# Sluttabell
Game::create([
    'name' => 'SHL Grundserie 2016',
    'type' => 'Order'
]);
Question::create([
    'title' => 'Sluttabell',
    'teams' => ['Färjestad', 'Frölunda', 'Skellefteå', 'Linköping', 'Växjö'],
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
    ],
    'worth' => 5,
    'answer' => 0,
    'game_id' => 1,
]);
Answer::create([
    'question_id' => 1,
    'answer' => [
        '1' => 'Färjestad',
        '2' => 'Skellefteå'
    ],
    'is_correct' => false
]);

/**
 * Medaljliga
 */
Game::create([
    'name' => 'Sverige - Belgien',
    'type' => 'Score'
]);
Question::create([
    'title' => 'Guld',
    'worth' => 5,
    'answer' => 0,
    'game_id' => 4,
]);
Question::create([
    'title' => 'Silver',
    'worth' => 3,
    'answer' => 0,
    'game_id' => 4,
]);
Question::create([
    'title' => 'Brons',
    'worth' => 1,
    'answer' => 0,
    'game_id' => 4,
]);
Answer::create([
    'question_id' => 1,
    'answer' => '1',
    'is_correct' => false
]);
Answer::create([
    'question_id' => 1,
    'answer' => '2',
    'is_correct' => false
]);
Answer::create([
    'question_id' => 1,
    'answer' => '3',
    'is_correct' => false
]);