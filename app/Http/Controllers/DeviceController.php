<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\DeviceModel;



class DeviceController extends Controller
{
    // Mostra tutti i dispositivi
    public function index()
    {
        $devices = Device::all();
        return view('devices.index', ['devices' => $devices]);
       // return view('devices.index', compact('devices'));
    }

    // Mostra il form per creare un nuovo dispositivo
    public function create()
    {
        $deviceModels = DeviceModel::all();
        return view('devices.create', compact('deviceModels'));
    }

    // Salva un nuovo dispositivo
    public function store(Request $request)
    {
        $request->validate([
            'imei' => 'required|unique:devices',
            'serial' => 'nullable',
            'iccid' => 'nullable',
            'device_model_id' => 'nullable|exists:device_models,id',
        ]);

        Device::create($request->all());

        return redirect()->route('devices.index')->with('success', 'Device creato con successo!');
    }

    // Mostra i dettagli di un singolo dispositivo
    public function show(Device $device)
    {
        return view('devices.show', compact('device'));
    }

    // Mostra il form per modificare un dispositivo
    public function edit(Device $device)
    {
        $deviceModels = DeviceModel::all();
        return view('devices.edit', compact('device', 'deviceModels'));
    }

    // Aggiorna un dispositivo
    public function update(Request $request, Device $device)
    {
        $request->validate([
            'imei' => 'required|unique:devices,serial,' . $device->id,
            'serial' => 'nullable',
            'iccid' => 'nullable',
            'device_model_id' => 'nullable|exists:device_models,id',

        ]);

        $device->update($request->all());

        return redirect()->route('devices.index')->with('success', 'Device aggiornato con successo!');
    }

    // Elimina un dispositivo
    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('devices.index')->with('success', 'Device eliminato!');
    }
}
