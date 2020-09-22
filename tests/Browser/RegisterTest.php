<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testHeCanRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('@name', 'John Doe')
                ->type('@phone', '06 07 08 09 10')
                ->type('@email', 'test@test.fr')
                ->type('@password', 'SuperPassword')
                ->type('@password_confirmation', 'SuperPassword')
                ->click('@submit')
                ->assertPathIs('/menu')
                ->visit('/user/profile')
                ->waitForLocation('/user/profile')
                ->assertInputValue('@name', 'John Doe')
                ->assertInputValue('@phone', '06 07 08 09 10')
                ->assertInputValue('@email', 'test@test.fr');
        });
    }
}
