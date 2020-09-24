<?php

namespace App\Http\Controllers;

use App\Models\ScheduledMeal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccueilController extends Controller
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

        $scheduledMealsOfWeek = ScheduledMeal::getScheduledMealsOfWeek($year, $week);

        return Inertia::render('Accueil', [
            'scheduledMealsOfWeek' => $scheduledMealsOfWeek->toArray(),
            'year' => $year,
            'week' => $week,
        ]);
    }
}
