<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;

class HorairesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Horaires', [
            'posts' => Post::where('page', 'horaires')
                ->where('published_at',  '<=', Date::now())
                ->orderBy('published_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->paginate(),
        ]);
    }
}
