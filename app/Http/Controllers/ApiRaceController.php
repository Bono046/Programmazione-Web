<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Race;
use App\Http\Resources\RaceResource;

class ApiRaceController extends Controller
{
    // Tutte le gare
    public function listRaces(Request $request)
    {
        $query = Race::query();

        // Se l'utente chiede i devices, facciamo eager loading
        if ($request->query('withDevices')) {
            $query->with('devices');
        }

        return RaceResource::collection($query->get());
    }

    // Singola gara
    public function raceWithDevices(Request $request, $id)
    {
        $query = Race::query();

        if ($request->query('withDevices')) {
            $query->with('devices');
        }

        $race = $query->findOrFail($id);

        return new RaceResource($race);
    }
}
