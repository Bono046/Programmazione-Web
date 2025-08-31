<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Device;
use App\Models\DeviceModel;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    public function index()
    {
        // Recupero tutte le gare con i dispositivi associati
        $races = Race::with('devices')->get();
        return view('races.index', compact('races'));
    }


    public function create()
    {
        return view('races.edit');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'devices' => 'array',
            'description' => 'nullable|string|max:1000',
        ]);

        $race = Race::create($validated);

        if (!empty($validated['devices'])) {
            $race->devices()->attach($validated['devices']);
        }

        return redirect()->route('races.index')->with('success', 'Gara creata con successo!');
    }


    public function show(Race $race)
    {
    $race->load('devices'); // eager load dispositivi
    return view('races.show', compact('race'));
    }


    public function edit(Race $race)
    {
        return view('races.edit', compact('race'));
    }


    public function update(Request $request, Race $race)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'devices' => 'array',
            'description' => 'nullable|string|max:1000',
        ]);

        $race->update($validated);

        // aggiorna la lista di dispositivi
        $race->devices()->sync($validated['devices'] ?? []);

        return redirect()->route('races.index')->with('success', 'Gara aggiornata con successo!');
    }


    public function destroy(Race $race)
    {
        $race->delete();
        return redirect()->route('races.index')->with('success', 'Gara eliminata correttamente!');
    }
    
        //$race->load('devices'); // eager load dispositivi

    public function manage(Race $race)
    {
        $models = DeviceModel::all();
        $devices = Device::all();
        return view('races.manage', compact('race', 'models', 'devices'));
    }


    // Aggiorna solo i dispositivi associati alla gara
    public function updateDevices(Request $request, Race $race)
    {
        $validated = $request->validate([
            'devices' => 'array',
            'devices.*' => 'exists:devices,id',
        ]);

        if ($request->has('devices')) {
            $race->devices()->sync($request->input('devices'));
        } else {
            $race->devices()->sync([]);
        }

        return redirect()->route('races.manage', $race)
            ->with('success', 'Dispositivi aggiornati correttamente!');
    }


}

