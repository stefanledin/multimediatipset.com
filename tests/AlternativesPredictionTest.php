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
            ->type('Sverige-Ryssland', 'title')
            ->select('Alternatives', 'type')
            ->press('Lägg till')
            // Sparades?
            ->see('Redigera fråga: Sverige-Ryssland')
            ->click('Tillbaka')
            ->see('Sverige-Ryssland');
    }

}
