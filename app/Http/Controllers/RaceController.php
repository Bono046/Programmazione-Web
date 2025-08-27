<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Device;
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
        // Recupero tutti i dispositivi per permettere la selezione
        $devices = Device::all();
        return view('races.create', compact('devices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'devices' => 'array', // array di device_id
        ]);

        // Creo la gara
        $race = Race::create($validated);

        // Associo i device selezionati (se presenti)
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
        $devices = Device::all();
        $race->load('devices');
        return view('races.edit', compact('race', 'devices'));
    }

    public function update(Request $request, Race $race)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'devices' => 'array',
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

}

