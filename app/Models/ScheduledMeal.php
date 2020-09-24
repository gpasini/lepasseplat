<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class ScheduledMeal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    public function meal() {
        return $this->belongsTo('App\Models\Meal');
    }

    public function bookings() {
        return $this->hasMany('App\Models\Booking');
    }

    public static function getScheduledMealsOfWeek($year, $week) {
        $date = Date::now()
            ->setISODate($year, $week)
            ->startOfWeek();

        $scheduledMeals = ScheduledMeal::with('meal')->whereBetween('date', [
            $date->toDateString(),
            $date->endOfWeek()->toDateString()
        ])
            ->get();

        return ScheduledMeal::getDaysOfWeek($date)
                ->mapWithKeys(function ($dayOfWeek) use ($scheduledMeals) {
                    return [
                        $dayOfWeek => collect(
                            $scheduledMeals
                                ->filter(function ($scheduledMeal) use ($dayOfWeek) {
                                    return Date::parse($dayOfWeek)->isSameDay($scheduledMeal->date);
                                })
                                ->values()
                                ->toArray()
                            )
                    ];
                });
    }

    public static function getDaysOfWeek($date) {
        return collect([
            $date->startOfWeek()->toDateString(),
            $date->startOfWeek()->addDays(1)->toDateString(),
            $date->startOfWeek()->addDays(2)->toDateString(),
            $date->startOfWeek()->addDays(3)->toDateString(),
            $date->startOfWeek()->addDays(4)->toDateString(),
        ]);
    }
}
