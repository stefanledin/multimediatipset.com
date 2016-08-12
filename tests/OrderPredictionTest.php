<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderPredictionTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_admin_can_create_game_type_order()
    {
        $admin = factory(App\User::class)->make(['is_admin' => true]);
        $this->actingAs($admin)
            ->visit('admin/game/new')
            ->type('SHL Grundserie', 'name')
            ->type(20, 'price')
            ->press('Skapa')
            // Sparades?
            ->see('SHL Grundserie')
            // Lägg till frågan
            ->type('Sluttabell', 'title')
            ->select('Order', 'type')
            ->press('Lägg till')
            // Sparades frågan?
            ->see('Sluttabell')
            // Lägg till alternativ
            ->type('Färjestad', 'alternative[0]')
            ->press('Uppdatera')
            ->see('Färjestad')
            ->type('Frölunda', 'alternative[1]')
            ->type('Skellefteå', 'alternative[2]')
            ->press('Uppdatera')
            ->see('Färjestad')
            ->see('Frölunda')
            ->see('Skellefteå')
            // Ange värde
            ->type(1, 'worth[default]')
            ->type(10, 'worth[alternatives][Färjestad]')
            ->type(20, 'worth[positions][1]')
            ->press('Uppdatera')
            // Sparades värdena?
            ->see('"worth[default]" value="1"')
            // (Detta är vad DOMCrawlern ser)
            ->see('"worth[alternatives][F&auml;rjestad]" value="10"')
            ->see('"worth[positions][1]" value="20"')
            ;
    }
}
