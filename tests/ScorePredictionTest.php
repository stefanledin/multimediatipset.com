<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScorePredictionTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_admin_can_create_and_edit_game_type_score()
    {
        $admin = factory(App\User::class)->make(['is_admin' => true]);
        $this->actingAs($admin)
            // Skapa tipset
            ->visit('/admin/game/new')
            ->see('Skapa nytt tips')
            ->type('Sverige - Italien', 'name')
            ->type(20, 'price')
            ->press('Skapa')
            // Sparades det?
            ->see('Sverige - Italien')
            ->see('20')
            // Lägg till och spara fråga
            ->type('Resultat', 'title')
            ->type('1', 'worth')
            ->see('Välj typ av tips')
            ->select('Score', 'type')
            ->press('Lägg till')
            // Sparades det?
            ->see('Frågor')
            ->see('Resultat')
            ->see('Värd: 1 poäng')
            ->see('Typ: Score')
            // Uppdatera
            ->click('Redigera')
            ->type('5', 'worth')
            ->press('Uppdatera')
            ->see('Värd: 5 poäng');
    }

    /*public function test_user_can_submit_prediction()
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
    }*/

}
