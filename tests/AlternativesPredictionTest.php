<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Game;
use App\Question;
use App\Answer;

class AlternativesPredictionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_create_and_edit_game_type_alternatives()
    {
        $admin = factory(App\User::class)->make(['is_admin' => true]);
        $this->actingAs($admin)
            // Skapa tipset
            ->visit('/admin/game/new')
            ->type('World Cup', 'name')
            ->type(40, 'price')
            ->press('Skapa')
            // Sparades?
            ->see('World Cup')
            ->see(40)

            // Lägg till frågor
            ->type('Gruppspel', 'title')
            ->select('Alternatives', 'type')
            ->press('Lägg till')
            // Sparades?
            ->see('Redigera fråga: Gruppspel')
            ->see('Alternatives')
            // Lägg till alternativ
            ->type('1', 'alternative[0]')
            ->press('Lägg till')
            ->type('X', 'alternative[1]')
            ->press('Lägg till')
            ->type('2', 'alternative[2]')
            ->press('Lägg till')
            // Sparades?
            ->see('id="alternative[2]"  value="2"');
    }

}
