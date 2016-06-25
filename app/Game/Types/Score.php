<?php

namespace App\Game\Types;

use App\Game;

class Score {

    protected $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function matches()
    {
        $matches = collect($this->game->data)->map(function($match) {
            // Refactor to a collection when you've become smarter
            $data = [];
            foreach (['match', 'result', 'worth'] as $key) {
                $data[$key] = isset($match[$key]) ? $match[$key] : null;
            }
            return (object) $data;
        });
        return $matches;
    }

}