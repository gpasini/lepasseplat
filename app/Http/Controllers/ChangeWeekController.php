<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;

class ChangeWeekController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $year = (int) $request->get('year');
        $week =  (int) $request->get('week');

        $date = Date::now()
            ->setISODate($year, $week)
            ->{$request->get('action') === 'next' ? 'addWeek' : 'subWeek'}();

        return Redirect::route($request->get('route', 'commander'), [
            'year' => (int) $date->format('Y'),
            'week' => (int) $date->format('W'),
        ]);
    }
}
