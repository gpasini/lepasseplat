<?php

namespace Tests\Browser;

use App\Models\ScheduledMeal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BookingTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testHeSeeCurrentMenu()
    {
        $this->browse(function (Browser $browser) {

            $sm1 = ScheduledMeal::factory()->create(['date' => Carbon::now()->startOfWeek()->toDateString()]);
            $sm2 = ScheduledMeal::factory()->create(['date' => Carbon::now()->startOfWeek()->addDays(1)->toDateString()]);
            $sm3 = ScheduledMeal::factory()->create(['date' => Carbon::now()->startOfWeek()->addDays(2)->toDateString()]);
            $sm4 = ScheduledMeal::factory()->create(['date' => Carbon::now()->startOfWeek()->addDays(3)->toDateString()]);
            $sm5 = ScheduledMeal::factory()->create(['date' => Carbon::now()->startOfWeek()->addDays(4)->toDateString()]);
            $sm6 = ScheduledMeal::factory()->create(['date' => Carbon::now()->startOfWeek()->addDays(5)->toDateString()]);
            $sm7 = ScheduledMeal::factory()->create(['date' => Carbon::now()->startOfWeek()->addDays(6)->toDateString()]);


            $browser->loginAs(User::factory()->create())
                ->visit('/commander')
                ->assertSee($sm1->meal->title)
                ->assertSee($sm2->meal->title)
                ->assertSee($sm3->meal->title)
                ->assertSee($sm4->meal->title)
                ->assertSee($sm5->meal->title)
                ->assertSee($sm6->meal->title)
                ->assertSee($sm7->meal->title);
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testHeCanBookMeal()
    {
        $this->browse(function (Browser $browser) {

            ScheduledMeal::factory()->create(['date' => Carbon::now()->startOfWeek()->toDateString()]);

            $browser->loginAs(User::factory()->create())
                ->visit('/commander')
                ->assertSee('Ajouter');
        });
    }
}
