<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;

class FrontController extends Controller
{
    public function getHome(): \Illuminate\View\View
    {
        $races = Race::all();
        $events = $races->map(function($race) {
            return [
                'title' => $race->name,
                'start' => $race->start_date->toDateString(),
                'end'   => $race->end_date->addDay()->toDateString(), // FullCalendar non include il giorno di fine, quindi +1
                'url'   => route('races.show', $race),
            ];
        });

        return view('index', [
            'events' => $events,
        ]);
    }

    public function getLogin(): \Illuminate\View\View
    {
        return view('auth.auth');
    }

  
}
