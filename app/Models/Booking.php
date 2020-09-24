<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'quantity',
        'scheduled_meal_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scheduledMeal()
    {
        return $this->belongsTo('App\Models\ScheduledMeal');
    }

    public static function getBookingsOfWeek($year, $week)
    {
        $date = Date::now()
            ->setISODate($year, $week)
            ->startOfWeek();

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

        return $daysOfWeek
            ->mapWithKeys(function ($dayOfWeek) use ($bookings) {
                return [
                    $dayOfWeek => $bookings
                        ->filter(function ($booking) use ($dayOfWeek) {
                            return Date::parse($dayOfWeek)->isSameDay($booking->scheduledMeal->date);
                        })
                        ->values()
                ];
            });
    }
}
