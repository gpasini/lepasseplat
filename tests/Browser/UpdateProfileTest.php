<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdateProfileTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testHeCanUpdateProfile()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/user/profile')
                ->type('@name', 'Edited')
                ->type('@phone', '0606070708')
                ->type('@email', 'edited@test.fr')
                ->click('@submit')
                ->waitForText('Enregistré')
                ->refresh()
                ->assertInputValue('@name', 'Edited')
                ->assertInputValue('@phone', '0606070708')
                ->assertInputValue('@email', 'edited@test.fr');
        });
    }
}
