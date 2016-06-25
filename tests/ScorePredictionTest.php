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

    public function test_user_can_submit_prediction()
    {
        $user = App\User::create(['username' => 'Stefan']);
        $user2 = App\User::create(['username' => 'CreamDiePie']);
        $game = App\Game::create([
            'name' => 'Hockey-VM',
            'price' => 20,
            'data' => [
                [
                    'match' => 'Sverige - Tjeckien'
                ]
            ]
        ]);
        $this->actingAs($user)
            ->visit('/')
            ->click('Hockey-VM')
            ->see('Hockey-VM')
            ->see('Pris: 20 kr.')
            ->see('I potten: 0 kr')
            ->see('Sverige - Tjeckien')
            ->type('3-1', 'data[0][answer]')
            ->press('Tippa')
            ->see('Stefan har tippat:')
            ->see('3-1')
            ->see('I potten: 20 kr');
        $this->actingAs($user2)
            ->visit('/')
            ->click('Hockey-VM')
            ->type('4-2', 'data[0][answer]')
            ->press('Tippa')
            ->see('Stefan har tippat:')
            ->see('CreamDiePie har tippat:')
            ->see('4-2')
            ->see('I potten: 40 kr');
    }

}
