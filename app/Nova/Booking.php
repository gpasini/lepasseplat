<?php

namespace App\Nova;

use App\Nova\Lenses\BookingsOfDay;
use App\Nova\Lenses\BookingsOfNextWeek;
use App\Nova\Lenses\BookingsOfTomorrow;
use App\Nova\Lenses\BookingsOfWeek;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;

class Booking extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Booking::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function label() {
        return 'Commandes';
    }

    public static function singularLabel()
    {
        return 'Commande';
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
            BelongsTo::make('Utilisateur', 'user', 'App\Nova\User'),

            BelongsTo::make('Plat', 'scheduledMeal', 'App\Nova\ScheduledMeal'),

            Number::make('Nombre de part', 'quantity'),
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
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new BookingsOfDay,
            new BookingsOfTomorrow,
            new BookingsOfWeek,
            new BookingsOfNextWeek,
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
        ];
    }
}
