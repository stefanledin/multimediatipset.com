<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScorePredictionTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_admin_can_create_game_type()
    {
        $admin = factory(App\User::class)->make(['is_admin' => true]);
        $this->actingAs($admin)
            ->visit('/admin/game/new')
            ->see('Skapa nytt tips')
            ->see('Välj typ av tips')
            ->select('Score', 'type')
            ->press('Välj')
            ->see('Redigera tips')
            ->type('Sverige - Belgien', 'name')
            ->type(20, 'price')
            ->press('Skapa')
            ->see('Sverige - Belgien')
            ->see('20')
            ->see('Speltyp: Score');
    }

}
