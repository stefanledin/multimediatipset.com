<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Game;
use App\Question;

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

    public function test_user_can_submit_prediction()
    {
        $user = User::create(['username' => 'Stefan']);
        $user2 = User::create(['username' => 'CreamDiePie']);
        $game = Game::create([
            'name' => 'Sverige - Belgien',
            'price' => 10
        ]);
        $question = new Question([
            'title' => 'Resultat',
            'worth' => 5,
            'type' => 'Score'
        ]);
        $game->questions()->save($question);

        $this->actingAs($user)
            ->visit('/')
            ->see('Aktuella tips')
            ->click('Sverige - Belgien')
            ->type('0-1', 'answer')
            ->press('Tippa');
        $this->actingAs($user2)
            ->visit('/')
            ->click('Sverige - Belgien')
            ->type('2-1', 'answer')
            ->press('Tippa')
            ->see('Stefan har tippat: 0-1')
            ->see('CreamDiePie har tippat: 2-1');
    }

    public function test_admin_can_create_game_type_score_with_multiple_questions()
    {
        $admin = factory(App\User::class)->make(['is_admin' => true]);
        $this->actingAs($admin)
            // Skapa tipset
            ->visit('/admin/game/new')
            ->see('Skapa nytt tips')
            ->type('Fotbolls-EM: Gruppspel', 'name')
            ->type(20, 'price')
            ->press('Skapa')
            
            // Lägg till och spara fråga
            ->type('Sverige - Nordirland', 'title')
            ->type('5', 'worth')
            ->see('Välj typ av tips')
            ->select('Score', 'type')
            ->press('Lägg till')
            // Lägg till och spara fråga
            ->type('Belgien - Italien', 'title')
            ->type('1', 'worth')
            ->see('Välj typ av tips')
            ->select('Score', 'type')
            ->press('Lägg till')
            
            // Sparades det?
            ->see('Frågor')
            ->see('Sverige - Nordirland')
            ->see('Belgien - Italien')
            ->see('Värd: 5 poäng')
            ->see('Värd: 1 poäng');
    }

}
