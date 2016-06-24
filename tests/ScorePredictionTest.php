<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScorePredictionTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_admin_can_create_game_type_score()
    {
        $admin = factory(App\User::class)->make(['is_admin' => true]);
        $this->actingAs($admin)
            ->visit('/admin/game/new')
            ->see('Skapa nytt tips')
            ->see('Välj typ av tips')
            ->select('Score', 'type')
            ->press('Välj')
            ->see('Redigera tips')
            ->type('Fotbolls-EM', 'name')
            ->type(20, 'price')
            ->press('Skapa')
            ->see('Fotbolls-EM')
            ->see('20')
            ->see('Speltyp: Score')
            ->type('Sverige - Belgien', 'data[0][match]')
            ->type(5, 'data[0][worth]')
            ->press('Lägg till')
            ->see('Sverige - Belgien')
            ->type('Italien - Sverige', 'data[1][match]')
            ->press('Lägg till')
            ->see('Sverige - Belgien')
            ->see('Italien - Sverige');
    }

}
