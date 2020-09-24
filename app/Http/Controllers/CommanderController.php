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

        $scheduledMealsOfWeek = ScheduledMeal::getScheduledMealsOfWeek($year, $week);

        $bookingsOfWeek = Booking::getBookingsOfWeek($year, $week);

        return Inertia::render('Commander', [
            'scheduledMealsOfWeek' => $scheduledMealsOfWeek
                ->map(function ($scheduledMealsOfDay) use ($bookingsOfWeek) {
                    return $scheduledMealsOfDay
                        ->map(function ($scheduledMeal) use ($bookingsOfWeek) {
                            $date = Date::parse($scheduledMeal['date']);

                            $scheduledMeal['bookable'] = ($date->isFuture() || $date->isToday()) && $bookingsOfWeek->flatten(1)->where('scheduled_meal_id', $scheduledMeal['id'])->count() === 0;

                            return $scheduledMeal;
                        });
                })
                ->toArray(),
            'bookingsOfWeek' => $bookingsOfWeek
                ->map(function ($bookingsOfDay) {
                    return $bookingsOfDay
                        ->map(function ($booking) {
                            $booking = $booking->toArray();

                            $date = Date::parse($booking['scheduled_meal']['date']);

                            $booking['editable'] = $date->isFuture() || $date->isToday();

                            return $booking;
                        });
            })
                ->toArray(),
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
