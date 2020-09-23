<?php

namespace App\Http\Controllers;

use App\Models\ScheduledMeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
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
        $year = (int) $request->get('year', date("Y"));
        $week =  (int) $request->get('week', date("W"));

        $date = Date::now()
            ->setISODate($year, $week)
            ->startOfWeek();

        $scheduledMeals = ScheduledMeal::with('meal')->whereBetween('date', [
            $date->toDateString(),
            $date->endOfWeek()->toDateString()
        ])
            ->get();

        return Inertia::render('Commander', [
            'scheduledMealsOfWeek' => collect([
                $date->toDateString(),
                $date->addDays(1)->toDateString(),
                $date->addDays(2)->toDateString(),
                $date->addDays(3)->toDateString(),
                $date->addDays(4)->toDateString(),
                $date->addDays(5)->toDateString(),
                $date->addDays(6)->toDateString(),
            ])
                ->mapWithKeys(function ($dayOfWeek) use ($scheduledMeals) {
                    return [
                        $dayOfWeek => $scheduledMeals
                            ->filter(function ($scheduledMeal) use ($dayOfWeek) {
                                return Date::parse($dayOfWeek)->isSameDay($scheduledMeal->date);
                            })
                            ->toArray()
                    ];
                })
                ->toArray(),
            'year' => $year,
            'week' => $week,
            'nextYear' => $year,
            'nextWeek' => $week,
            'previousYear' => $year,
            'previousWeek' => $week,
        ]);
    }
}
