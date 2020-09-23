<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ScheduledMeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $bookings = Booking::with('scheduledMeal.meal')->whereHas('scheduledMeal', function ($query) use ($date) {
            $query->whereBetween('date', [
                $date->toDateString(),
                $date->endOfWeek()->toDateString()
            ]);
        })
            ->where('user_id', Auth::user()->id)
            ->get();

        $daysOfWeek = collect([
            $date->toDateString(),
            $date->addDays(1)->toDateString(),
            $date->addDays(2)->toDateString(),
            $date->addDays(3)->toDateString(),
            $date->addDays(4)->toDateString(),
        ]);

        $bookingsOfWeek = $daysOfWeek
            ->mapWithKeys(function ($dayOfWeek) use ($bookings) {
                return [
                    $dayOfWeek => $bookings
                        ->filter(function ($booking) use ($dayOfWeek) {
                            return Date::parse($dayOfWeek)->isSameDay($booking->scheduledMeal->date);
                        })
                        ->values()
                        ->toArray()
                ];
            });

        return Inertia::render('Commander', [
            'scheduledMealsOfWeek' => $daysOfWeek
                ->mapWithKeys(function ($dayOfWeek) use ($scheduledMeals, $bookingsOfWeek) {
                    return [
                        $dayOfWeek => collect(
                            $scheduledMeals
                                ->filter(function ($scheduledMeal) use ($dayOfWeek) {
                                    return Date::parse($dayOfWeek)->isSameDay($scheduledMeal->date);
                                })
                                ->values()
                                ->toArray()
                            )
                                ->map(function ($scheduledMeal) use ($bookingsOfWeek) {
                                    $date = Date::parse($scheduledMeal['date']);

                                    $scheduledMeal['bookable'] = ($date->isFuture() || $date->isToday()) && $bookingsOfWeek->flatten(1)->where('scheduled_meal_id', $scheduledMeal['id'])->count() === 0;

                                    return $scheduledMeal;
                                })
                                ->toArray()
                    ];
                })
                ->toArray(),
            'bookingsOfWeek' => $bookingsOfWeek->toArray(),
            'hasBooking' => $bookingsOfWeek->flatten(1)->count() > 0,
            'year' => $year,
            'week' => $week,
            'nextYear' => $year,
            'nextWeek' => $week,
            'previousYear' => $year,
            'previousWeek' => $week,
        ]);
    }
}
