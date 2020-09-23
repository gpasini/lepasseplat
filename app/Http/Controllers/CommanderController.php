<?php

namespace App\Http\Controllers;

use App\Models\ScheduledMeal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommanderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $year = $request->get('year', (int) date("Y"));
        $week =  $request->get('week', (int) date("W"));

        $date = new Carbon;
        $date->setISODate($year, $week);

        $scheduledMeals = ScheduledMeal::with('meal')->whereBetween('date', [
            $date->startOfWeek()->toDateString(),
            $date->endOfWeek()->toDateString()
        ])
            ->get();

        return Inertia::render('Commander', [
            'scheduledMealsOfWeek' => collect([
                $date->startOfWeek()->toDateString(),
                $date->addDays(1)->toDateString(),
                $date->addDays(1)->toDateString(),
                $date->addDays(1)->toDateString(),
                $date->addDays(1)->toDateString(),
                $date->addDays(1)->toDateString(),
                $date->addDays(1)->toDateString(),
            ])
                ->mapWithKeys(function ($dayOfWeek) use ($scheduledMeals) {
                    return [
                        $dayOfWeek => $scheduledMeals
                            ->filter(function ($scheduledMeal) use ($dayOfWeek) {
                                return Carbon::parse($dayOfWeek)->isSameDay(Carbon::parse(($scheduledMeal->date)));
                            })
                            ->toArray()
                    ];
                })
                ->toArray()
        ]);
    }
}
