<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    protected $gameTypes = [
        'Score' => 'Resultat/poäng',
        'Order' => 'Ordning/placering',
        'Alternatives' => '1-x-2/Alternativ'
    ];

}
