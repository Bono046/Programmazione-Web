<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Device;
use App\Models\DeviceModel;
use Illuminate\Http\Request;
use App\Models\MissingDevice;

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
    

    public function confirmDelete(Race $race)
    {
        return view('races.show', compact('race'))->with('confirmDelete', true);
    }

    public function manage(Race $race)
    {
        $models = DeviceModel::all();
        $devices = Device::all();
        $missingDevices = MissingDevice::where('race_id', $race->id)->with('device', 'race')->get();
        $tab = session('tab', 'partenza');
        return view('races.manage', compact('race', 'models', 'devices', 'missingDevices', 'tab'));

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
            ->with('success', 'Dispositivi aggiornati correttamente!')
            ->with('activeTab', 'partenza');
    }


    public function markMissing(Request $request, Race $race)
    {
        $missingDevices = $request->input('missing', []);

        foreach ($missingDevices as $deviceId) {
            $missing = MissingDevice::where('race_id', $race->id)
            ->where('device_id', $deviceId)
            ->first();

            if ($missing) {
                $missing->update(['returned' => 0]);
            } else {
                MissingDevice::create([
                    'race_id' => $race->id,
                    'device_id' => $deviceId,
                    'returned' => 0,
                ]);
            }
        }
        return redirect()->route('races.manage', $race)
            ->with('success', 'Dispositivi mancanti segnalati!')
            ->with('activeTab', 'rientro');
    }


    public function markReturned(MissingDevice $missingDevice)
    {
        $missingDevice->update(['returned' => true]);

        return back()->with('success', 'Dispositivo segnato come rientrato!')
            ->with('activeTab', 'rientro');
    }




}

