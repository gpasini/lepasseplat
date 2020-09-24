<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;

class ServicesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Services', [
            'posts' => Post::where('page', 'services')
                ->where('published_at',  '<=', Date::now())
                ->orderBy('published_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->paginate()
        ]);
    }
}
