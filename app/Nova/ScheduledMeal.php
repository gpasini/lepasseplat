<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;

class ScheduledMeal extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ScheduledMeal::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'date',
    ];

    public function title()
    {
        return $this->meal->title . ' ('. $this->date->format('m/d/Y') .')';
    }

    public static function label()
    {
        return 'Plats au menu';
    }

    public static function singularLabel()
    {
        return 'Plat au menu';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Plat', 'meal', 'App\Nova\Meal')->showCreateRelationButton(),
            Date::make('Date')->rules(['required', 'date'])->format('DD/MM/YYYY')->firstDayOfWeek(1),
            HasMany::make('Réservations', 'bookings', 'App\Nova\Booking'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\ScheduledDateFilter,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
